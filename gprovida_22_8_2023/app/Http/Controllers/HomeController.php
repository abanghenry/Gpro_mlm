<?php

namespace App\Http\Controllers;

use App\Events\OrderConfirmed;
use App\Events\ProductOrdered;
use App\Jobs\ProcessPaymentAwardBonus;
use App\Jobs\ProcessPaymentBinaryBonus;
use App\Jobs\ProcessPaymentGenerationalBonus;
use App\Jobs\ProcessPaymentGlobalSalesBonus;
use App\Jobs\ProcessPaymentLoyaltyBonus;
use App\Jobs\ProcessPaymentRepurchaseBonus;
use App\Jobs\ProcessPaymentSpecialBonus;
use App\Jobs\ProcessPaymentStockistBonus;
use App\Mail\ContactForm;
use App\Mail\SupportCreated;
use App\Mail\SupportUpdated;

use App\Models\Bank;
use App\Models\BonusBinary;
use App\Models\BonusDirectPurchase;
use App\Models\BonusReferral;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Support;
use App\Models\UpgradeRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function testmail(){
        $support = Support::find(3);
        $reply = Support::find(5);
        $user = Auth::user();
        return (new SupportUpdated($support,$reply, $user, false))->render();
        return (new SupportCreated($support, $user, false))->render();
    }

    public function testbinary(){
        $users = User::with('downlines')
                 ->whereHas('downlines', function($query){
                      $query->where('current_binary_pv', '>=', 30);  // TODO update to combine current_binary_pv +spill_over_binary_pv
                     //$query->whereRaw('current_binary_pv + spill_over_binary_pv >= 30');
                     //$query->whereRaw('current_binary_pv + spill_over_binary_pv >= 30');
                 },'>', 1)
                 ->get();
        dd($users);
    }



    public function testjobs(){
       //$job = (new ProcessPaymentAwardBonus());
       //$this->dispatch($job);

       dd('testjobs');

//        Bank::where('status', 1)
//            ->update(['default' => 1]);


    }

    public function installAward_pv_not_tobeusedagain(){
        $binary_packages = Setting::where('key','binary_bonus_packages')->first();
        $binaryPackageArray =array_filter(explode(',',trim($binary_packages->value)));
        $allQualifiedUsers = User::has('referred', '>=', 2)->whereIn('package_id', $binaryPackageArray)->with('downlines')->get();

        $list = array();
        $line = array('user_id', 'username',
            'leftID','leftPV',
            'righID','rightPV',
            'award_pv', 'award_pv_left', 'award_pv_right'
        );

        $list[] =$line;

         echo "allQualifiedUsers: ".count($allQualifiedUsers);
        foreach ($allQualifiedUsers as $qualifiedUser ){
            if($qualifiedUser->downlines->count() >1){

                $leftPV  = $qualifiedUser->downlines[0]->cumulative_binary_pv - $qualifiedUser->downlines[0]->current_binary_pv;
                $rightPV = $qualifiedUser->downlines[1]->cumulative_binary_pv - $qualifiedUser->downlines[1]->current_binary_pv;

                $no_of_match = 0;
                if($leftPV> $rightPV){
                  $no_of_match = $rightPV/30;
                }else{
                  $no_of_match = $leftPV/30;
                }

                $award_pv = $no_of_match*30;
                $qualifiedUser->award_pv_left += $award_pv/2;
                $qualifiedUser->award_pv_right += $award_pv/2;
                $qualifiedUser->save();

                $line = array($qualifiedUser->id, $qualifiedUser->username,
                              $qualifiedUser->downlines[0]->id,$leftPV,
                              $qualifiedUser->downlines[1]->id,$rightPV,
                              $award_pv, $award_pv/2, $award_pv/2
                            );
                $list[] =$line;
            }
        }

        $fp = fopen('installAward_pv.csv', 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);



    }


    public function restoreOrderPV(){
        /*
        $orders = Order::find([390,388,383,382,366,344,334,332,328,320,316]);
        foreach ($orders as $order){
            //event(new OrderConfirmed($order));
        }
        */
        dd("366");
    }




    public function dashboard()
    {
        $user = User::with('downlines','package', 'currency')
                    ->find(Auth::user()->id);
        $orders = Order::where('user_id', $user->id)->get()->groupBy('status_order');
        $orderSummary= array();
        foreach ($orders as $key => $value){
            $orderSummary[$key]  = count($value);
        }


        $lastorders =  OrderItem::whereHas('order', function ($query) {
            return $query->where('user_id', '=', Auth::user()->id);
        })->with('order','product','currency')->orderBy('id', 'desc')->take(6)->get();

        $latestReferralBonus = BonusReferral::where('user_id', $user->id)
            ->with('referred')->orderBy('id', 'desc')->take(10)->get();
        $latestBinaryBonus = BonusBinary::where('user_id', $user->id)
            ->with('referred')->orderBy('id', 'desc')->take(10)->get();
        $latestDirectBonus = BonusDirectPurchase::where('user_id', $user->id)
                            ->orderBy('id', 'desc')->take(10)->get();
        $latestPayment     = Payment::where('user_id', $user->id)
            ->with('currency')->orderBy('id', 'desc')->take(10)->get();

        $currentReferralBonus = BonusReferral::where('user_id', $user->id)->where('status',0)->where('source','referral')->sum('amount');
        $currentStockistBonus = BonusReferral::where('user_id', $user->id)->where('status',0)->where('source','referral_stockist')->sum('amount');

        $totalEarning = Payment::where('user_id', $user->id)->where('status','paid')->sum('amount');
        $totalPendingEarning = Payment::where('user_id', $user->id)->where('status','pending')->sum('amount');

        $earningLoyalty = Payment::where('user_id', $user->id)->where('bonus_type','loyalty')->sum('amount');
        $earningGlobal  = Payment::where('user_id', $user->id)->where('bonus_type','global')->sum('amount');
        $earningSpecial = Payment::where('user_id', $user->id)->where('bonus_type','special')->sum('amount');
        $earningStockist = Payment::where('user_id', $user->id)->where('bonus_type','stockist')->sum('amount');


        $estimateBinaryEarning=0;
        $pv_to_amount= $user->currency->pv_rate;
        $matchSV =30;

        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $loyalty_bonus_value =  ($loyalty_bonus->value/100);

        if($user->downlines->count() >1){
            $leftLeg = $user->downlines[0]->current_binary_pv+$user->downlines[0]->spill_over_binary_pv;
            $rightleg= $user->downlines[1]->current_binary_pv+$user->downlines[1]->spill_over_binary_pv;

            if($leftLeg>1 && $rightleg>1){
                $weakLeg =$leftLeg; $strongLeg =$rightleg;
                if($leftLeg>$rightleg){
                    $weakLeg=$rightleg; $strongLeg = $leftLeg;
                }
                $binary_type = Setting::where('key','binary_type')->first();
                if($binary_type->value =="'1:1'"){
                    if($strongLeg >= $weakLeg){
                        // matched
                        $match = intval($weakLeg/$matchSV);
                        $estimateBinaryEarning= $match*$pv_to_amount*4.5;

                        $loyalty_bonus = $estimateBinaryEarning*$loyalty_bonus_value;
                        $estimateBinaryEarning = $estimateBinaryEarning-$loyalty_bonus;

                    }
                }else{
                    if($strongLeg >= $weakLeg*2 ){
                        // matched
                        $match = intval($weakLeg/$matchSV);
                        $estimateBinaryEarning= $match*$pv_to_amount*4.5;

                        $loyalty_bonus = $estimateBinaryEarning*$loyalty_bonus_value;
                        $estimateBinaryEarning = $estimateBinaryEarning-$loyalty_bonus;
                    }
                }

            }
        }

        return Inertia::render('Dashboard', [
            'pageTitle'=>"Dashboard",
            'user'=>$user,
            'orderSummary'=>$orderSummary,
            'lastorders'=>$lastorders,
            'latestReferralBonus'=>$latestReferralBonus,
            'latestBinaryBonus'=>$latestBinaryBonus,
            'latestDirectBonus'=>$latestDirectBonus,
            'latestPayment'=>$latestPayment,
            'currentReferralBonus'=>$currentReferralBonus,
            'currentStockistBonus'=>$currentStockistBonus,
            'totalEarning'=>$totalEarning,
            'totalPendingEarning'=>$totalPendingEarning,

            'earningLoyalty'=>$earningLoyalty,
            'earningGlobal'=>$earningGlobal,
            'earningSpecial'=>$earningSpecial,
            'earningStockist'=>$earningStockist,
            'estimateBinaryEarning'=>$estimateBinaryEarning,
        ] );

    }

    public function inactivelock(){

        if(Auth::user()->active==1){
            return redirect('/dashboard');
        }

        return Inertia::render('InactiveLockscreen', [
            'user'=>Auth::user(),
        ]);
    }




    public function welcomepack(){
        if(Auth::user()->welcomed==1){
            return redirect('/dashboard');
        }
        $products = Product::with('category','price.currency')->get();
        $categories= ProductCategory::all();
        $user = User::with('package.priceUser', 'currency')->find(Auth::user()->id);

        $cartSession =Session::get('cart');
        $cartSessionLength = $cartSession? count($cartSession):0;
        Session::put('owner_id', $user->id);

        return Inertia::render('WelcomePack/SelectWelcomePack', [
            'pageTitle'=>"Select Welcome Package Products",
            'products'=>$products,
            'categories'=>$categories,
            'user'=>$user,
            'cartSession'=>$cartSession,
            'cartSessionTotalAmount'=>$this->getCartTotal($cartSession),
            'cartSessionLength'=>$cartSessionLength
        ]);
    }

    public function welcomepackOrderProductDetails(Request $request){
        $product =  Product::find($request->id);
        if(!$product){
            return redirect('/welcomepack')->with(['status'=>"product not found"]);
        }
        return redirect('welcomepack/product/'.$product->name);
    }
    public function welcomepackshowProduct($name){
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

        return Inertia::render('WelcomePack/ProductDetails', [
            'pageTitle'=>"Products",
            'product'=>$product,
            'similarProducts'=>$similarProducts,
            'user'=>$this->buyer,
            'userPriceCurrency'=>$userPriceCurrency,
        ] );
    }
    public function welcomepackStoreCart(Request $request){ // store to session
        $request->validate([
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $user = User::with('package.priceUser', 'currency')->find(Auth::user()->id);
        $totalAmount = floatval($this->getCartTotal(Session::get('cart')));
        $userPackageAmount = floatval($user->package->priceUser[0]->price);
        if($totalAmount> $userPackageAmount){
            return redirect('/welcomepack')->with(['error'=>"Total Order amount can't exceed ".$user->currency->prefix.$userPackageAmount]);
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
        return redirect('welcomepack/cart');
    }
    public function welcomepackShowCart(){
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

        return Inertia::render('WelcomePack/ShoppingCart', [
            'cart'=>$cart,
            'currency'=>$buyersCurrency,
            'user'=>Auth::user(),
            'stores'=>$stores,
            'totalAmount'=>$totalAmount,
            'itemCount'=>$itemCount,
        ] );
    }
    public function welcomepackDeleteItemFromCart(Request $request){
        $cart = Session::get('cart');
        foreach ($cart as $key => $value){
            if($key == $request->id ){
                unset($cart[$key]);
            }
        }
        Session::put('cart', $cart);
        return redirect('welcomepack/cart');
    }
    public function welcomepackStoreOrder(Request $request){
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
        $userPackageAmount = floatval($user->package->priceUser[0]->price);
        if($totalAmount> $userPackageAmount){
            return redirect('welcomepack/cart')->with(['error'=>"Total Order amount can't exceed ".$user->currency->prefix.$userPackageAmount]);
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
        $user->welcomed = 1;
        $user->save();


        // event new order
        event(new ProductOrdered($order, $user));
        return redirect('dashboard')->with(['success'=>'Welcome Pack Order Successful and will soon be processed']);
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





    public function contactform(Request $request){

        $name = $request->contactsName;
        $email = $request->contactsEmail;
        $message = $request->contactsMessage;

        // send to user
        Mail::to($email)->send(new ContactForm($name, $email, $message));

        //send notification/email to all admin
        $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
        foreach ($systemAdmins as $recipient) {
            Mail::to($recipient)->send(new ContactForm($name, $email, $message));
        }

        $message="Message sent";
        return response()->json($message);


    }




}
