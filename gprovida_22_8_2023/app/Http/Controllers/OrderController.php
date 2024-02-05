<?php

namespace App\Http\Controllers;

use App\Events\ProductOrdered;
use App\Mail\OrderPlaced;
use App\Mail\SupportCreated;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class OrderController extends Controller
{
    //

    Public $buyer;
    Public $buyersCurrency;


    public function order(){
        $products = Product::with('category','price.currency')->get();
        $categories= ProductCategory::all();
        $user = Auth::user();
        $cartSession =Session::get('cart');
        $cartSessionLength = $cartSession? count($cartSession):0;

        Session::put('owner_id', $user->id); //TODO get from request

        return Inertia::render('Shop/Order', [
            'pageTitle'=>"Order Products",
            'products'=>$products,
            'categories'=>$categories,
            'user'=>$user,
            'cartSession'=>$cartSession,
            'cartSessionLength'=>$cartSessionLength
        ]);
    }

    public function orderProductDetails(Request $request){
        $product =  Product::find($request->id);
        if(!$product){
            return redirect('order')->with(['status'=>"product not found"]);
        }
        return redirect('order/product/'.$product->name);
    }
    public function show($name){
        $product =  Product::where('name', $name)
                            ->with('price.currency','category','images')
                            ->first();
        if(!$product){
           return redirect('order')->with(['status'=>"product not found"]);
        }
        $similarProducts = Product::where('category_id', $product->category_id)
                            ->whereNot('id',$product->id)
                            ->with('price.currency')
                            ->take(5)
                            ->get();
        $this->buyer = Auth::user();
        $priceList = $product->price;
        $userPriceCurrency = $priceList->filter(function ($value, $key) {
            return $value->currency_id == $this->buyer->currency_id;
        });

        return Inertia::render('Shop/OrderProductDetails', [
            'pageTitle'=>"Products",
            'product'=>$product,
            'similarProducts'=>$similarProducts,
            'user'=>$this->buyer,
            'userPriceCurrency'=>$userPriceCurrency,
        ] );
    }


    public function storeCart(Request $request){ // store to session
        $request->validate([
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        $product =  Product::find($request->productId);
        $newItem =  array('productId'=>$request->productId,
                            'productName'=>$product->name,
                            'productPrice'=>$request->price,
                            'productPriceCurrencyId'=>$request->priceCurrencyId,
                            'productqty'=>$request->qty,
                            'productAmount'=>$request->qty*$request->price,
                            'productImg'=>$product->image_url,
                        );
        $cart = Session::get('cart');
        if(!$cart){
            $cart[$request->productId] = $newItem;
        }else{
            $incart = false;
            foreach ($cart as $key => $value){
                 if($key == $request->productId ){
                     $incart = true;
                     $cart[$key]['productqty']+= $request->qty;
                     $cart[$key]['productAmount']+= ($request->qty*$request->price);
                 }
            }
            if(!$incart){
                $cart[$request->productId] = $newItem;
            }
        }

        $this->buyer = Auth::user();
        $this->buyersCurrency = Currency::find($this->buyer->currency_id);
        Session::put('buyersCurrency', $this->buyersCurrency);
        Session::put('cart', $cart);
        return redirect('order/cart');
    }
    public function showCart(){
        $stores = Store::all();
        $cart = Session::get('cart');
        $totalAmount=0; $itemCount=0;
        if(!$cart){
            return redirect('order');
        }
        foreach ($cart as $key => $value){
            $totalAmount += $value['productAmount'];
            $itemCount++;
        }
        Session::put('totalAmount', $totalAmount);
        Session::put('itemCount', $itemCount);

        $buyersCurrency = Session::get('buyersCurrency');

        return Inertia::render('Shop/ShoppingCart', [
            'cart'=>$cart,
            'currency'=>$buyersCurrency,
            'user'=>Auth::user(),
            'stores'=>$stores,
            'totalAmount'=>$totalAmount,
            'itemCount'=>$itemCount,
        ] );
    }

    public function deleteItemFromCart(Request $request){
        $cart = Session::get('cart');
        foreach ($cart as $key => $value){
            if($key == $request->id ){
                unset($cart[$key]);
            }
        }
        Session::put('cart', $cart);
        return redirect('order/cart');
    }

    public function storeOrder(Request $request){
        $request->validate([
            'selectedStore' => 'required',
            'paymentMethod' => 'required',
        ]);
        //  save transaction
        if(!empty($_SERVER ['REMOTE_ADDR'])) {
            $ip = $_SERVER ['REMOTE_ADDR'];
        }else{
            $ip = 'unknown';
        }

        $user = Auth::user();
        $cart = Session::get('cart');

        $order = new Order();
        $order->orderRef        =  strtoupper(substr(md5(time().rand(100000,999999)), 0, 8));
        $order->status_order    = "pending";
        $order->user_id         = $user->id;
        $order->owner_id        = Session::get('owner_id');
        $order->store_id        = $request->selectedStore;
        $order->currency_id     = Session::get('buyersCurrency')->id;
        $order->number_of_items = Session::get('itemCount');
        $order->total_sales     = Session::get('totalAmount');
        $order->total_tax       = 0;
        $order->total_shipping  = 0;
        $order->transaction_fee = 0;
        $order->total_discount  = 0;
        $order->net_total       = Session::get('totalAmount');
        $order->invoice_no      = "";
        $order->payment_method  = $request->paymentMethod;
        $order->payment_status  = "pending";
        $order->ip_address      = $ip;
        $order->save();

        foreach ($cart as $key => $value){
            $product = Product::find($key);
            $order_item              = new OrderItem();
            $order_item->order_id    =  $order->id;
            $order_item->product_id  =  $product->id;
            $order_item->name        =  $product->name;
            $order_item->description =  $product->desc;
            $order_item->type        =  'item';
            $order_item->qty         =  $value['productqty'];
            $order_item->currency_id =  $value['productPriceCurrencyId'];
            $order_item->amount      =  $value['productPrice'];
            $order_item->discount    =  '';
            $order_item->total       =  $value['productAmount'];
            $order_item->status      =  'pending';
            $order_item->store_id    =  $request->selectedStore;
            $order_item->save();
        }

        // clear session data
        Session::forget('cart');
        Session::forget('owner_id');
        Session::forget('buyersCurrency');
        Session::forget('itemCount');
        Session::forget('totalAmount');



        // event new order
        event(new ProductOrdered($order, $user));




        // store Order + details
        // generate invoice
        // send email to user and admin
        // send notification (SMS to admin)

        //Emails
          // 1) Order Placed
          // 2) Customer Invoice
          // 3) Invoice Payment Confirmation
          // 4) Order Confirmation
          // 5) Order Shipped Confirmation


        // add bonus when apporved
        // Deduct from inventory
        // notify stockist
        return redirect('order/history')->with(['success'=>'Order Successful and will soon be processed']);
    }



    public function orderHistory(){
        $myOrders = Order::where('user_id', Auth::user()->id)
                            ->with('items', 'owner','store', 'currency')->get();
        return Inertia::render('Shop/History')->with(['orders'=>$myOrders]);
    }

    public function orderHistoryShow($id){
        $myOrder = Order::where('id', $id)
                         ->where('user_id', Auth::user()->id)
                         ->with('items', 'owner','store', 'currency')
                         ->first();
        if($myOrder){
            return Inertia::render('Shop/OrderDetails')->with(['order'=>$myOrder]);
        }else{
            return redirect('order/history')->with(['error'=>'Order not found']);
        }
    }


}
