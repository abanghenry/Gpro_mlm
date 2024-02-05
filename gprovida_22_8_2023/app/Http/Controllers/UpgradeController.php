<?php

namespace App\Http\Controllers;

use App\Events\ProductOrdered;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Models\UpgradeRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class UpgradeController extends Controller
{


    public function upgradepack(){

        if(Auth::user()->upgrade_welcomed==1){
            return redirect('/dashboard');
        }
        $products = Product::with('category','price.currency')->get();
        $categories= ProductCategory::all();
        $user = User::with('package.priceUser', 'currency')->find(Auth::user()->id);

        $cartSession =Session::get('cart');
        $cartSessionLength = $cartSession? count($cartSession):0;
        Session::put('owner_id', $user->id);

        $upgradeRecord = UpgradeRecord::find($user->upgrade_record_id);
        $upgradeRecordAmount = $upgradeRecord->new_package_cost - $upgradeRecord->old_package_cost;

        return Inertia::render('UpgradePack/SelectUpgradePack', [
            'pageTitle'=>"Select Upgrade Package Products",
            'products'=>$products,
            'categories'=>$categories,
            'user'=>$user,
            'cartSession'=>$cartSession,
            'cartSessionTotalAmount'=>$this->getCartTotal($cartSession),
            'cartSessionLength'=>$cartSessionLength,
            'upgradeRecordAmount'=>$upgradeRecordAmount,
        ]);
    }

    public function upgradepackOrderProductDetails(Request $request){
        $product =  Product::find($request->id);
        if(!$product){
            return redirect('/upgradepack')->with(['status'=>"product not found"]);
        }
        return redirect('upgradepack/product/'.$product->name);
    }

    public function upgradepackshowProduct($name){
        $product =  Product::where('name', $name)
            ->with('price.currency','category','images')
            ->first();
        if(!$product){
            return redirect('upgradepack')->with(['status'=>"product not found"]);
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
        return Inertia::render('UpgradePack/ProductDetails', [
            'pageTitle'=>"Products",
            'product'=>$product,
            'similarProducts'=>$similarProducts,
            'user'=>$this->buyer,
            'userPriceCurrency'=>$userPriceCurrency,
        ] );
    }

    public function upgradepackStoreCart(Request $request){ // store to session
        $request->validate([
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        $user = User::with('package.priceUser', 'currency')->find(Auth::user()->id);
        $totalAmount = floatval($this->getCartTotal(Session::get('cart')));

        $upgradeRecord = UpgradeRecord::find($user->upgrade_record_id);
        $userUpgradePackageAmount = $upgradeRecord->new_package_cost - $upgradeRecord->old_package_cost;

        if($totalAmount> $userUpgradePackageAmount){
            return redirect('/upgradepack')->with(['error'=>"Total Order amount can't exceed ".$user->currency->prefix.$userUpgradePackageAmount]);
        }


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
        return redirect('upgradepack/cart');
    }

    public function upgradepackShowCart(){
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

        return Inertia::render('UpgradePack/ShoppingCart', [
            'cart'=>$cart,
            'currency'=>$buyersCurrency,
            'user'=>Auth::user(),
            'stores'=>$stores,
            'totalAmount'=>$totalAmount,
            'itemCount'=>$itemCount,
        ] );
    }
    public function upgradepackDeleteItemFromCart(Request $request){
        $cart = Session::get('cart');
        foreach ($cart as $key => $value){
            if($key == $request->id ){
                unset($cart[$key]);
            }
        }
        Session::put('cart', $cart);
        return redirect('upgradepack/cart');
    }
    public function upgradepackStoreOrder(Request $request){
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

        $user = User::with('package.priceUser', 'currency')->find(Auth::user()->id);
        $totalAmount = floatval(Session::get('totalAmount'));

        $upgradeRecord = UpgradeRecord::find($user->upgrade_record_id);
        $userUpgradePackageAmount = $upgradeRecord->new_package_cost - $upgradeRecord->old_package_cost;
        if($totalAmount> $userUpgradePackageAmount){
            return redirect('upgradepack/cart')->with(['error'=>"Total Order amount can't exceed ".$user->currency->prefix.$userUpgradePackageAmount]);
        }

        $cart = Session::get('cart');

        $order = new Order();
        $order->orderRef        =  strtoupper(substr(md5(time().rand(100000,999999)), 0, 8));
        $order->status_order    = "pending";
        $order->user_id         = $user->id;
        $order->owner_id        = Session::get('owner_id');
        $order->store_id        = $request->selectedStore;
        $order->currency_id     = Session::get('buyersCurrency')->id;
        $order->number_of_items = Session::get('itemCount');
        $order->total_sales     = $totalAmount;
        $order->total_tax       = 0;
        $order->total_shipping  = 0;
        $order->transaction_fee = 0;
        $order->total_discount  = 0;
        $order->net_total       = $totalAmount;
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


        //update user, set welcomed to true
        $user->upgrade_welcomed = 1;
        $user->save();


        // event new order
        event(new ProductOrdered($order, $user));
        return redirect('dashboard')->with(['success'=>'Upgrade Pack Order Successful and will soon be processed']);
    }
    public function getCartTotal($cart){
        if($cart){
            $totalAmount=0;
            foreach ($cart as $key => $value){
                $totalAmount += $value['productAmount'];
            }
            return  $totalAmount;
        }else{
            return 0;
        }
    }

}
