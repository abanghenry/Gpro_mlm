<?php

namespace App\Listeners;

use App\Events\UserActivated;
use App\Models\BonusBinary;
use App\Models\BonusReferral;
use App\Models\Currency;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\Setting;
use App\Models\User;
use App\Models\UsersLoginLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class GenealogyAddRegistrationBonus implements ShouldQueue
{
    const PV_GEN_LIMIT = 1000;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserActivated  $event
     * @return void
     */
    public function handle(UserActivated $event)
    {
        // set active, date activated
        $user = $event->user;
        $user->active = 1;
        $user->date_activated =  date("Y-m-d H:i:s");
        $user->save();

        // set position
        //1) spill_over_preference: balanced, extreme_left,extreme_right,weak_side
        $spillOverPref = Setting::where('key','spill_over_preference')->first();
        // check if space is vacant
        $parent = $event->user->referred_by;
        if($event->parent){
            $parent = $event->parent;
        }


        if($event->position){
            $space = User::where('parent', $parent)->where('position', $event->position)->get();
            if($space->count() > 0){ // use default spill over, registration may orignate from internal
                 $this->fixUserPositionDefault($user,$parent);
            }else{
                $user->parent   = $parent;
                $user->position = intval($event->position);
                $user->save();
            }
        }else{
            switch ($spillOverPref->value){
                case "balanced":
                    $this->fixUserPositionBalance($user,$parent);
                    break;
                case "extreme_left":
                    $this->fixUserPositionExtremeLeft($user,$parent);
                    break;
                case "extreme_right":
                    $this->fixUserPositionExtremeRight($user,$parent);
                    break;
                case "weak_side":
                    $this->fixUserPositionWeakSide($user,$parent);
                    break;
                default:
                    $this->fixUserPositionDefault($user,$parent);
            }
        }
        // add referral bonus
        $this->addReferralBonus($user);
        // add genealogy bonus
        $this->updateUplink($user);
    }

    public function fixUserPositionDefault(User $user,$parent): User
    {
        $notFound = true;
        while($notFound){
            $rows = User::where('parent', $parent)->get();
            if($rows->count() > 1 ){
                if($rows[0]->id == $parent){ // break loop when parent and user is same
                    $parent = $rows[1]->id;
                }else{
                    $parent = $rows[0]->id;
                }
            }elseif($rows->count() == 1){
                if($rows[0]->position=='1' ){
                    $user->parent = $parent;
                    $user->position = 2;
                    $user->save();
                }else{
                    $user->parent = $parent;
                    $user->position = 1;
                    $user->save();
                }
                $notFound = false;
            }else{
                $user->parent = $parent;
                $user->position = 1;
                $user->save();
                $notFound = false;
            }
        }
        return $user;
    }
    public function fixUserPositionBalance(User $user,$parent): User
    {
        $notFound = true;
        $parentArray = array();
        while($notFound){
            $rows = User::where('parent', $parent)->get();
            if($rows->count() > 1 ){
                array_push($parentArray, $rows[0]->id, $rows[1]->id);
                if($rows[0]->id == $parent){ // break loop when parent and user is same
                    $parent1 = array_shift($parentArray);
                    $parent = array_shift($parentArray);
                }else{
                    $parent = array_shift($parentArray);
                }

            }elseif($rows->count() == 1){
                if($rows[0]->position=='1' ){
                    $user->parent = $parent;
                    $user->position = 2;
                    $user->save();
                }else{
                    $user->parent = $parent;
                    $user->position = 1;
                    $user->save();
                }
                $notFound = false;
            }else{
                $user->parent = $parent;
                $user->position = 1;
                $user->save();
                $notFound = false;
            }
        }
        return $user;
    }
    public function fixUserPositionExtremeLeft(User $user,$parent): User
    {
        $notFound = true;
        while($notFound){
            $rows = User::where('parent',$parent)->where('position', 1)->get();
            if($rows->count() >0 ){
                if($rows[0]->id == $parent){ // break loop when parent and user is same
                    $parent = $rows[1]->id;
                }else{
                    $parent = $rows[0]->id;
                }
            }else{
                $user->parent = $parent;
                $user->position = 1;
                $user->save();
                $notFound = false;
            }

        }
        return $user;
    }
    public function fixUserPositionExtremeRight(User $user,$parent): User
    {
        $notFound = true;
        while($notFound){
            $rows = User::where('parent',$parent)->where('position', 2)->get();
            if($rows->count() >0 ){
                if($rows[0]->id == $parent){ // break loop when parent and user is same
                    $parent = $rows[1]->id;
                }else{
                    $parent = $rows[0]->id;
                }
            }else{
                $user->parent = $parent;
                $user->position = 2;
                $user->save();
                $notFound = false;
            }
        }
        return $user;
    }
    public function fixUserPositionWeakSide(User $user,$parent): User
    {
        $notFound = true;
        while($notFound){
            $rows = User::where('parent', $parent)->get();
            if($rows->count() >1 ){
                // find weaker leg
                $legZeroTotalPV = $this->findSalesVolume($rows[0]->id);
                $legOneTotalPV =  $this->findSalesVolume($rows[1]->id);
                if($legOneTotalPV >$legZeroTotalPV){
                    $parent = $rows[0]->id;
                }else{
                    $parent = $rows[1]->id;
                }
            }elseif($rows->count() == 1){
                if($rows[0]->position=='1' ){
                    $user->parent = $parent;
                    $user->position = 2;
                    $user->save();
                }else{
                    $user->parent = $parent;
                    $user->position = 1;
                    $user->save();
                }
                $notFound = false;
            }else{
                $user->parent = $parent;
                $user->position = 1;
                $user->save();
                $notFound = false;
            }
        }
        return $user;
    }

    //TODO verify accuracy of saleVolume
    public function findSalesVolume($id){
        $user = User::find($id);
        if($user){
            return BonusBinary::where('user_id',$id)->sum('pv'); //$saleVolume
        }else{
            return 0;
        }
    }

    public function addReferralBonus(User $user){
        $sponsor = User::find($user->referred_by);
        if(!$sponsor){ // if no sponsor
            return;
        }

        $package = Package::find($user->package_id);
        $referral_bonus_percent = $package->referral_bonus;

        $referral_bonus_format = Setting::where('key','referral_bonus_format')->first();
        if($referral_bonus_format->value=='amount'){ //|| $referral_bonus_format->value=='pv' because henry is to stubborn and damage the system, I will have to force both amount and pv here
            $package_price = PackagePrice::where('package_id',$package->id)
                                           ->where('currency_id',$user->currency_id)
                                           ->first();
            $earned_amount = ($referral_bonus_percent/100)*$package_price->price;
            $earned_pv = ($referral_bonus_percent/100)*$package->pv;

            $ref_bonus = new BonusReferral();
            $ref_bonus->user_id           = $sponsor->id;
            $ref_bonus->referral_id       = $user->id; // whose action generated the bonus
            $ref_bonus->currency_id       = $package_price->currency_id;
            $ref_bonus->currency_code     = $package_price->currency_code;
            $ref_bonus->amount            = $earned_amount;
            $ref_bonus->pv                = $earned_pv;
            $ref_bonus->date_time_earned  = date("Y-m-d H:i:s");
            $ref_bonus->source           = "referral";
            $ref_bonus->status            = 0; // pending
            $ref_bonus->details           = "Referral bonus earned from user: ".$user->username;
            $ref_bonus->save();
        }else{
            $earned_pv = ($referral_bonus_percent/100)*$package->pv;

            $currency = Currency::find($user->currency_id);
            $pv_currency = $currency->pv_rate;
            // add referral bonus if PV is used
            $ref_bonus = new BonusReferral();
            $ref_bonus->user_id           = $sponsor->id;
            $ref_bonus->referral_id       = $user->id; // whose action generated the bonus

            $ref_bonus->currency_id       = $currency->id;
            $ref_bonus->currency_code     = $currency->code;
            $ref_bonus->amount            = $earned_pv*$pv_currency;

            $ref_bonus->pv                = $earned_pv;
            $ref_bonus->date_time_earned  = date('Y-m-d H:i:s', strtotime('today 23:50'));
            $ref_bonus->source           = "referral";
            $ref_bonus->status           = 0; // pending
            $ref_bonus->details           = "Referral bonus earned from user: ".$user->username;
            $ref_bonus->save();
        }

    }

    public function updateUpLink($user){
        $username = $user->username;
        $package = Package::find($user->package_id);
        $pv = $package->pv;
        $referral_id = $user->id;
        $notFound = true;
        $counter=0;
        // counter to count pv generation
        $limitCounter = 0;

        while($notFound){
            $parent = $this->findParent($user);

            if($limitCounter >= self::PV_GEN_LIMIT){
                break;
            }

            if(!$parent){
                $notFound = false;
            }elseif($user->id == $parent->id){
                $notFound = false;   // end loop if found
            }else{
                // add referral pv
                if(floatval($pv)>0){
                    $binary_bonus = new BonusBinary();
                    $binary_bonus->user_id           = $parent->id;
                    $binary_bonus->referral_id       = $referral_id;
                    $binary_bonus->pv                = $pv;
                    $binary_bonus->date_time_earned  = date("Y-m-d H:i:s");
                    $binary_bonus->source           = "referral";
                    $binary_bonus->status           = 0; // pending
                    $binary_bonus->details           = "Referral uplink PV bonus earned from user: ".$username;
                    $binary_bonus->save();
                    // update BonusBinary on users column
                    $parent->current_binary_pv += $pv;
                    $parent->cumulative_binary_pv += $pv;
                    $parent->save();
                }

                // update new user
                $user =$parent;
            }

            $limitCounter++;
        }
    }

    public function findParent(User $user){
        if(isset($user->parent)){
            $parent  = User::find($user->parent);
            return $parent;
        }
        return null;
    }


    public function failed(UserActivated $event, $exception)
    {
        //TODO notify site email about this failure, so it can be done manually
    }

}
