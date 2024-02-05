<?php

namespace App\Http\Controllers;

use App\Events\UserActivated;
use App\Events\UserUpgraded;
use App\Models\BonusBinary;
use App\Models\BonusDirectPurchase;
use App\Models\BonusReferral;
use App\Models\Currency;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\Payment;
use App\Models\Pin;
use App\Models\Setting;
use App\Models\UpgradeRecord;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Notifications\UserUpgradedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Illuminate\Validation\Rules;


class MLMController extends Controller
{

     public $paid_bonus;

    public function genealogy(){
        $user = User::with('downlines.downlines.downlines.downlines')
                        ->find(Auth::user()->id);
        return Inertia::render('Genealogy/Index', [
            'user'=>$user,
            'pageTitle'=>"Genealogy",
            ] );
    }

    public function view($encrypted_id){
        try {
            $id = Crypt::decryptString($encrypted_id);
        }catch (DecryptException $exception){
            return redirect('/genealogy')->with(['error'=>'Unknown user']);
        }

        $user = User::with('downlines.downlines.downlines.downlines')
            ->find($id);
        return Inertia::render('Genealogy/Index', [
            'user'=>$user,
            'pageTitle'=>"Genealogy",
        ] );

    }

    public function addTeamMember(){
        $referral = Auth::user();
        $parent   = $referral;
        $location = '';
        if(request()->has('referred_by')){
            $referral = User::find(request('referred_by'));
        }
        if(request()->has('parent')){
            $parent = User::find(request('parent'));
        }
        if(request()->has('location')){
            $location = request('location');
        }
        $countries = DB::table('countries')->get();
        $packages = Package::with('price')->where('type','!=','stockist')->get();
        return Inertia::render('Genealogy/AddTeamMember', [
            'pageTitle'=>"Genealogy",
            'parent'=>$parent,
            'referral'=>$referral,
            'position'=>$location,
            'user'=>Auth::user(),
            'countries' => $countries,
            'packages' => $packages,
        ] );
    }

    public function storeTeamMember(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'package_id' => 'required',
            'payment_method' => 'required',
            'currency_id' => 'required',
        ]);

        $sponsor = User::with('package.priceUser','currency')->find(Auth::user()->id);
        // verify epin
        $usercontroller = new UserController();
        if($request->payment_method =="epin"){
            $pin_details = Pin::where('pin_number', $request->epin)->where('status', '0')->first();
            if(!$pin_details){
                return redirect('/genealogy')->with(['error'=>'E-pin is Invalid or used, Confirm and try again']);
            }
            if($pin_details->package_id != $request->package_id){
                return redirect('/genealogy')->with(['error'=>'E-pin is Invalid for selected Package, Confirm and try again']);
            }
            /*
            $pin = $usercontroller->checkPinUser($request->epin, $request->package_id, $sponsor->id);
            if(!$pin){
                return redirect('/genealogy')->with(['error'=>"E-Pin Selected does not belong to logged in User, Confirm and try again"]);
            }
            */

        }
        // verify if amount is enough
        $package = Package::with('priceUser')->find($request->package_id);
        $package_cost = $package->priceUser[0]->price;
        if($request->payment_method =="wallet"){
            if($package_cost>$sponsor->wallet){
                return redirect('/genealogy')->with(['error'=>"You don't have enough money in your wallet to make this upgrade"]);
            }
        }



        // verify referred by
        $referral = User::where('username',$request->referred_by)->first();
        if(!$referral){
            $referral   = User::where('type', '5')->first();
        }

        // verify Parent
        $parent = User::where('username',$request->parent)->first();
        if(!$parent){
            $parent   = $referral;
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'gender' => $request->gender,
            'email' => $request->email,
            'profession' => $request->profession,
            'skills' => "",
            'phone' => $request->phone,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'referred_by' => $referral->id,
            'package_id' => $request->package_id,
            'payment_method'=> $request->payment_method,
            'currency_id' => $request->currency_id,
            'active' => 0,
            'type' => 1,
            'registration_pin' => $request->epin,
            'password' => Hash::make($request->password),
        ]);

        // update pin
        if($request->payment_method =="epin"){
            $pin_details = Pin::where('pin_number', $request->epin)->where('status', '0')->first();
            $usercontroller->updatePinUsed($pin_details, $user);
            // Pin used, Activate user
            event(new UserActivated($user, $parent->id, $request->position));
        }

        if($request->payment_method =="wallet"){
            $sponsor->wallet -= $package_cost;
            $sponsor->save();
            WalletTransaction::create([
                'user_id'=> $user->id,
                'amount' => $package_cost,
                'type' => 'debit',
                'currency_code' => $sponsor->currency->code,
                'currency_id' => $sponsor->currency->id,
                'details' => "Registration cost for user: ".$user->username,
            ]);


            // Pin used, Activate user
            event(new UserActivated($user, $parent->id, $request->position));
        }

        event(new Registered($user));

        return redirect('/genealogy')->with(['success'=>'Team member Added Successfully']);

    }


    public function changeUserToEpin(Request $request){
        $request->validate([
            'userId' => 'required',
            'epin' => 'required|string|max:255',
            'payment_method' => 'required',
            'currency_id' => 'required',
        ]);

        $user = Auth::user();
        // verify epin
        $usercontroller = new UserController();
        if($request->payment_method =="epin"){
            $pin = $usercontroller->checkPin($request->epin, $request->package_id);
            if(!$pin){
                return redirect('/inactivelock')->with(['error'=>'Invalid E-Pin for selected Package, Confirm and try again']);
            }


            // update pin
            $pin_details = Pin::where('pin_number', $request->epin)->where('status', '0')->first();
            $usercontroller->updatePinUsed($pin_details, $user);
            $user->payment_method = "epin";
            $user->registration_pin =$request->epin;
            $user->save();

            // Pin used, Activate user
            $position=""; $parent_id=$user->referred_by;
            event(new UserActivated($user, $parent_id, $position));
            return redirect('/dashboard')->with(['success'=>'Activation  Successfully']);
        }

        return redirect('/dashboard');

    }



    public function upgrade(){
        $user = User::with('package.priceUser', 'currency')->find(Auth::user()->id) ;
        $packages = Package::where('type','package')->with('priceUser')->get();
        return Inertia::render('Profile/Upgrade', ['user'=>$user, 'packages'=>$packages]);
    }

    public function upgradeStore(Request $request){

        $request->validate([
            'username' => 'required',
            'currentPackageID' => 'required',
            'newPackage' => 'required',
        ]);

        $user = User::with('package.priceUser','currency')->find(Auth::user()->id);

        $current_package = $user->package;
        $current_package_cost = $current_package->priceUser[0]->price;
        $new_package = Package::with('priceUser')->find($request->newPackage);
        $new_package_cost = $new_package->priceUser[0]->price;

        $upgradeCost = $new_package_cost -$current_package_cost;
        //confirm amount available in wallet
        if($upgradeCost>$user->wallet){
            return redirect('/upgrade')->with(['error'=>"You don't have enough money in your wallet to make this upgrade"]);
        }
        if($current_package_cost > $new_package_cost){
            return redirect('/upgrade')->with(['error'=>"You can't upgrade to lower plan"]);
        }
        if($current_package_cost == $new_package_cost){
            return redirect('/upgrade')->with(['error'=>"You can't upgrade to the same plan"]);
        }

        //deduct from wallet, update user package
        $user->wallet -= $upgradeCost;
        $user->package_id = $new_package->id;
        $user->save();
        // add wallet activity
        WalletTransaction::create([
            'user_id'=>$user->id,
            'amount' => $upgradeCost,
            'type' => 'debit',
            'currency_code' => $user->currency->code,
            'currency_id' => $user->currency->id,
            'details' => "wallet debit for upgrade, from ".$current_package->name." to ".$new_package->name,
        ]);


        // add referral bonus
        $previous_referral_bonus_percent = $current_package->referral_bonus;
        $previous_earned_amount = ($previous_referral_bonus_percent/100)*$current_package_cost;
        $previous_earned_pv = ($previous_referral_bonus_percent/100)*$current_package->pv;

        // call event, add all uplink bonus
        $this->addReferralBonus($user,$previous_earned_amount, $previous_earned_pv);
        $previous_pv = $current_package->pv;
        $this->updateUpLink($user, $previous_pv);

        // notify upgraded user
            $user->notify(new UserUpgradedNotification($new_package));
        // save the record
            $upgrade_record = new UpgradeRecord();
            $upgrade_record->user_id          = $user->id;
            $upgrade_record->sponsor_id       = $user->referred_by;

            $upgrade_record->old_package_id   = $current_package->id;
            $upgrade_record->old_package_name = $current_package->name;
            $upgrade_record->old_package_pv   = $current_package->pv;
            $upgrade_record->old_package_cost = $current_package_cost;

            $upgrade_record->new_package_id   = $new_package->id;
            $upgrade_record->new_package_name = $new_package->name;
            $upgrade_record->new_package_pv   = $new_package->pv;
            $upgrade_record->new_package_cost = $new_package_cost;

            $upgrade_record->balance_pv       = $new_package->pv-$current_package->pv;
            $upgrade_record->balance_referral_bonus  = $this->paid_bonus;
            $upgrade_record->save();

        // add upgrade wall
        $user->upgrade_welcomed = 0;
        $user->upgrade_record_id = $upgrade_record->id;
        $user->save();


        event(new UserUpgraded($user,$current_package,$new_package ));
        return redirect('/dashboard')->with(['success'=>'upgrade Successfully']);
    }

    public function addReferralBonus(User $user, $previous_earned_amount, $previous_earned_pv){
        $sponsor = User::find($user->referred_by);
        if(!$sponsor){ // if no sponsor
            return;
        }

        $package = Package::find($user->package_id);
        $referral_bonus_percent = $package->referral_bonus;

        $referral_bonus_format = Setting::where('key','referral_bonus_format')->first();
        if($referral_bonus_format->value=='amount'){
            $package_price = PackagePrice::where('package_id',$package->id)
                ->where('currency_id',$user->currency_id)
                ->first();
            $exp_earned_amount = ($referral_bonus_percent/100)*$package_price->price;
            $earned_amount = $exp_earned_amount -$previous_earned_amount;
            $ref_bonus = new BonusReferral();
            $ref_bonus->user_id           = $sponsor->id;
            $ref_bonus->referral_id       = $user->id; // whose action generated the bonus
            $ref_bonus->currency_id       = $package_price->currency_id;
            $ref_bonus->currency_code     = $package_price->currency_code;
            $ref_bonus->amount            = $earned_amount;
            $ref_bonus->date_time_earned  = date("Y-m-d H:i:s");
            $ref_bonus->source           = "upgrade";
            $ref_bonus->status            = 0; // pending
            $ref_bonus->details           = "Referral upgrade bonus earned from user: ".$user->username;
            $ref_bonus->save();
        }else{
            $exp_earned_pv = ($referral_bonus_percent/100)*$package->pv;
            $earned_pv = $exp_earned_pv -$previous_earned_pv;
            // add referral bonus if PV is used

            $currency = Currency::find($sponsor->currency_id);
            $pv_currency = $currency->pv_rate;

            $ref_bonus = new BonusReferral();
            $ref_bonus->user_id           = $sponsor->id;
            $ref_bonus->referral_id       = $user->id; // whose action generated the bonus

            $ref_bonus->currency_id       = $currency->id;
            $ref_bonus->currency_code     = $currency->code;
            $ref_bonus->amount            = $earned_pv*$pv_currency;

            $ref_bonus->pv                = $earned_pv;
            $ref_bonus->date_time_earned  = date('Y-m-d H:i:s', strtotime('today 23:50'));
            $ref_bonus->source            = "upgrade";
            $ref_bonus->status            = 0; // pending
            $ref_bonus->details           = "Referral upgrade bonus earned from user: ".$user->username;
            $ref_bonus->save();

            $this->paid_bonus =  $earned_pv*$pv_currency;



            /*
            $earned_pv = ($referral_bonus_percent/100)*$package->pv;
            $currency = Currency::find($user->currency_id);
            $pv_currency = $currency->pv_rate;
            // add referral bonus if PV is used
             //$ref_bonus = new BonusReferral();
            */



        }

    }

    public function updateUpLink($user,$previous_pv){
        $username = $user->username;
        $package = Package::find($user->package_id);
        $pv = $package->pv - $previous_pv;
        $referral_id = $user->id;
        $notFound = true;
        $counter=0;
        while($notFound){
            $parent = $this->findParent($user);
            if(!$parent){
                $notFound = false;
            }elseif($user->id == $parent->id){
                $notFound = false;   // end loop if found
            }else{
                // add referral pv
                $binary_bonus = new BonusBinary();
                $binary_bonus->user_id           = $parent->id;
                $binary_bonus->referral_id       = $referral_id;
                $binary_bonus->pv                = $pv;
                $binary_bonus->date_time_earned  = date("Y-m-d H:i:s");
                $binary_bonus->source           = "upgrade";
                $binary_bonus->status           = 0; // pending
                $binary_bonus->details           = "Referral upgrade uplink PV bonus earned from user: ".$username;
                $binary_bonus->save();
                // update BonusBinary on users column
                $parent->current_binary_pv += $pv;
                $parent->cumulative_binary_pv += $pv;
                $parent->save();

                // update new user
                $user =$parent;
            }
        }
    }

    public function findParent(User $user){
        if(isset($user->parent)){
            $parent  = User::find($user->parent);
            return $parent;
        }
        return null;
    }




    public function referral(){
        $referral = User::where('referred_by',Auth::user()->id)->get();
        return Inertia::render('Genealogy/Referrals', ['referrals'=>$referral]);
    }






    public function payment(){
        $user = User::with('currency')->find(Auth::user()->id);
        $payments = Payment::where('user_id',$user->id)->orderBy('id','desc')->get();
        return Inertia::render('Payout/Payment', ['payments'=>$payments, 'user'=>$user]);
    }

    public function bonusreferral(){
        $user = User::with('currency')->find(Auth::user()->id);
        $bonus = BonusReferral::with('currency')
                                ->where('user_id',$user->id)
                                ->orderBy('id','desc')->get();
        return Inertia::render('Payout/ReferralBonus', ['bonus'=>$bonus, 'user'=>$user]);
    }

    public function bonusproduct(){
        $user = User::with('currency')->find(Auth::user()->id);
        $bonus = BonusDirectPurchase::where('user_id',$user->id)->orderBy('id','desc')->get();
        return Inertia::render('Payout/Bonus', ['title'=>"Product PV",'bonus'=>$bonus, 'user'=>$user]);
    }

    public function bonusbinary(){
        $user = User::with('currency')->find(Auth::user()->id);
        $bonus = BonusBinary::where('user_id',$user->id)->orderBy('id','desc')->get();
        return Inertia::render('Payout/Bonus', ['title'=>"Binary",'bonus'=>$bonus, 'user'=>$user]);
    }


}
