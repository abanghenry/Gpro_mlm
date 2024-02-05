<?php

namespace App\Jobs;

use App\Helpers\Helper;
use App\Models\BinaryPaymentLog;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessPaymentBinaryBonus implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $matchSV =30;
    public $from;
    public $to;
    public $loyalty_bonus_percentage;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        date_default_timezone_set('Africa/Lagos');
        $start_time = date('H:i:s');
        $this->from = date('Y-m-d H:i:s', strtotime('0:00 last monday'));
        $this->to   = date('Y-m-d H:i:s', strtotime('23:59 last sunday'));




        // settings
        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $this->loyalty_bonus_percentage =  $loyalty_bonus->value;
        $binary_packages = Setting::where('key','binary_bonus_packages')->first();
        $binaryPackageArray =array_filter(explode(',',trim($binary_packages->value)));

        $users = User::withCount('referred')->with('downlinesWith30PV','currency')
                ->whereHas('downlinesWith30PV',  function($query){ },'>', 1)
                ->get();

        $binary_type = Setting::where('key','binary_type')->first();
        foreach ($users as $user){
            // conditions 2: if user in approved package for binary bonus
            if(in_array($user->package_id, $binaryPackageArray) && ($user->referred_count >1) ){
                $userPackagePrice = $user->package->priceCurrency($user->currency->id);
                $capping = 0;
                if($userPackagePrice->count()>0){
                    $capping =$userPackagePrice[0]->capping;
                }

                // calculate and post earning/payment
                $estimateBinaryEarning=0;
                $pv_to_amount= $user->currency->pv_rate;
                if($user->downlinesWith30PV->count() >1){
                    $leftLeg  = $user->downlinesWith30PV[0]->current_binary_pv+$user->downlinesWith30PV[0]->spill_over_binary_pv;
                    $rightLeg = $user->downlinesWith30PV[1]->current_binary_pv+$user->downlinesWith30PV[1]->spill_over_binary_pv;
                    $weakLegIndex = 0; $strongLegIndex =1;
                    // make spillover zero
                    $weakLeg =$leftLeg; $strongLeg =$rightLeg;
                    if($leftLeg>$rightLeg){
                        $weakLeg=$rightLeg; $strongLeg = $leftLeg;
                        $weakLegIndex = 1; $strongLegIndex =0;
                    }


                    if($binary_type->value =="'1:1'"){
                        if($strongLeg >= $weakLeg){ // matched $matchSV==30
                            $match = intval($weakLeg/$this->matchSV);
                            $estimateBinaryEarning= $match*$pv_to_amount*4.5;
                            $w_carried_fwd =$weakLeg%$this->matchSV;
                            $s_carried_fwd =$strongLeg - ($match*$this->matchSV);

                            $this->createBinaryPayment($user, $estimateBinaryEarning, $capping);

                            $user->downlinesWith30PV[$weakLegIndex]->spill_over_binary_pv =$w_carried_fwd;
                            $user->downlinesWith30PV[$weakLegIndex]->current_binary_pv =0;
                            $user->downlinesWith30PV[$weakLegIndex]->last_cycle_binary =date('Y-m-d');
                            $user->downlinesWith30PV[$weakLegIndex]->save();

                            $user->downlinesWith30PV[$strongLegIndex]->spill_over_binary_pv =$s_carried_fwd;
                            $user->downlinesWith30PV[$strongLegIndex]->current_binary_pv =0;
                            $user->downlinesWith30PV[$strongLegIndex]->last_cycle_binary =date('Y-m-d');
                            $user->downlinesWith30PV[$strongLegIndex]->save();

                            $parameters = array('strong_leg_id'=>$user->downlinesWith30PV[$strongLegIndex]->id,'strong_leg_pv'=>$strongLeg,'strong_leg_cf'=>$s_carried_fwd,
                                'weak_leg_id'=>$user->downlinesWith30PV[$weakLegIndex]->id,'weak_leg_pv'=>$weakLeg,'weak_leg_cf'=>$w_carried_fwd,
                                'match_sv_used'=>$this->matchSV,'no_of_match'=>$match,'pv_to_amount'=>$pv_to_amount,'estimate_earning'=>$estimateBinaryEarning);
                            $this->recordBinaryPaymentLogs($user, $parameters);

                            // update award column PV
                            $this->updateAwardPVColumn($user, $weakLegIndex,$match );

                        }else{
                            // move current to spillover
                            $user->downlinesWith30PV[0]->spill_over_binary_pv =$user->downlinesWith30PV[0]->current_binary_pv;
                            $user->downlinesWith30PV[0]->current_binary_pv=0;
                            $user->downlinesWith30PV[0]->save();

                            $user->downlinesWith30PV[1]->spill_over_binary_pv =$user->downlinesWith30PV[1]->current_binary_pv;
                            $user->downlinesWith30PV[1]->current_binary_pv=0;
                            $user->downlinesWith30PV[1]->save();
                        }
                    }elseif ($binary_type->value =="'3:2'"){
                        if($strongLeg*2 >= $weakLeg*3){ // TODO cross check later

                            $match = intval($weakLeg/$this->matchSV);
                            $estimateBinaryEarning= $match*$pv_to_amount*4.5; // *4.5= 15% of 30pv
                            $w_carried_fwd =$weakLeg%$this->matchSV;
                            $s_carried_fwd =$strongLeg - ($match*$this->matchSV*1.5);
                            $this->createBinaryPayment($user, $estimateBinaryEarning, $capping);

                            $user->downlinesWith30PV[$weakLegIndex]->spill_over_binary_pv =$w_carried_fwd;
                            $user->downlinesWith30PV[$weakLegIndex]->current_binary_pv =0;
                            $user->downlinesWith30PV[$weakLegIndex]->last_cycle_binary =date('Y-m-d');
                            $user->downlinesWith30PV[$weakLegIndex]->save();

                            $user->downlinesWith30PV[$strongLegIndex]->spill_over_binary_pv =$s_carried_fwd;
                            $user->downlinesWith30PV[$strongLegIndex]->current_binary_pv =0;
                            $user->downlinesWith30PV[$strongLegIndex]->last_cycle_binary =date('Y-m-d');
                            $user->downlinesWith30PV[$strongLegIndex]->save();


                            $parameters = array('strong_leg_id'=>$user->downlinesWith30PV[$strongLegIndex]->id,'strong_leg_pv'=>$strongLeg,'strong_leg_cf'=>$s_carried_fwd,
                                'weak_leg_id'=>$user->downlinesWith30PV[$weakLegIndex]->id,'weak_leg_pv'=>$weakLeg,'weak_leg_cf'=>$w_carried_fwd,
                                'match_sv_used'=>$this->matchSV,'no_of_match'=>$match,'pv_to_amount'=>$pv_to_amount,'estimate_earning'=>$estimateBinaryEarning);
                            $this->recordBinaryPaymentLogs($user, $parameters);

                            // update award column PV
                            $this->updateAwardPVColumn($user, $weakLegIndex,$match );
                        }else{
                            // move current to spillover
                            $user->downlinesWith30PV[0]->spill_over_binary_pv =$user->downlinesWith30PV[0]->current_binary_pv;
                            $user->downlinesWith30PV[0]->current_binary_pv=0;
                            $user->downlinesWith30PV[0]->save();

                            $user->downlinesWith30PV[1]->spill_over_binary_pv =$user->downlinesWith30PV[1]->current_binary_pv;
                            $user->downlinesWith30PV[1]->current_binary_pv=0;
                            $user->downlinesWith30PV[1]->save();
                        }
                    }else{//default '2:1' //$binary_type->value == "'2:1'"
                        if($weakLeg*2 >= $strongLeg){
                            $match = intval($weakLeg/$this->matchSV);
                            $estimateBinaryEarning= $match*$pv_to_amount*4.5;
                            $w_carried_fwd =$weakLeg%$this->matchSV*4.5;
                            $s_carried_fwd =$strongLeg - ($match*$this->matchSV*2);
                            $this->createBinaryPayment($user, $estimateBinaryEarning, $capping);

                            $user->downlinesWith30PV[$weakLegIndex]->spill_over_binary_pv =$w_carried_fwd;
                            $user->downlinesWith30PV[$weakLegIndex]->current_binary_pv =0;
                            $user->downlinesWith30PV[$weakLegIndex]->last_cycle_binary =date('Y-m-d');
                            $user->downlinesWith30PV[$weakLegIndex]->save();

                            $user->downlinesWith30PV[$strongLegIndex]->spill_over_binary_pv =$s_carried_fwd;
                            $user->downlinesWith30PV[$strongLegIndex]->current_binary_pv =0;
                            $user->downlinesWith30PV[$strongLegIndex]->last_cycle_binary =date('Y-m-d');
                            $user->downlinesWith30PV[$strongLegIndex]->save();

                            $parameters = array('strong_leg_id'=>$user->downlinesWith30PV[$strongLegIndex]->id,'strong_leg_pv'=>$strongLeg,'strong_leg_cf'=>$s_carried_fwd,
                                'weak_leg_id'=>$user->downlinesWith30PV[$weakLegIndex]->id,'weak_leg_pv'=>$weakLeg,'weak_leg_cf'=>$w_carried_fwd,
                                'match_sv_used'=>$this->matchSV,'no_of_match'=>$match,'pv_to_amount'=>$pv_to_amount,'estimate_earning'=>$estimateBinaryEarning);
                            $this->recordBinaryPaymentLogs($user, $parameters);

                            // update award column PV
                            $this->updateAwardPVColumn($user, $weakLegIndex,$match );

                        }else{
                            // move current to spillover
                            $user->downlinesWith30PV[0]->spill_over_binary_pv =$user->downlinesWith30PV[0]->current_binary_pv;
                            $user->downlinesWith30PV[0]->current_binary_pv=0;
                            $user->downlinesWith30PV[0]->save();

                            $user->downlinesWith30PV[1]->spill_over_binary_pv =$user->downlinesWith30PV[1]->current_binary_pv;
                            $user->downlinesWith30PV[1]->current_binary_pv=0;
                            $user->downlinesWith30PV[1]->save();
                        }
                    }
                    // move balance to spillover , cumulative
                }
            }
        }

        // get all qualified but PV not up to 30 - move current to spill_over
        $userLowerPV = User::has('referred', '>=', 2)->whereIn('package_id', $binaryPackageArray)->with('downlines')->get();
        foreach ($userLowerPV as $notQualifiedThisCycle ){
            foreach ($notQualifiedThisCycle->downlines as $downline){
                $downline->spill_over_binary_pv += $downline->current_binary_pv;
                $downline->current_binary_pv =0;
                $downline->save();
            }
        }
        // make all remaining current =0
        DB::table('users')->update(['current_binary_pv' => 0]);


    }

    public function createBinaryPayment($user, $amount, $capping){
        // reserve some for loyalty bonus
        if(($capping > 0) && ( $amount> $capping)){
            $amount = $capping;
        }
        $loyalty_bonus = $amount*($this->loyalty_bonus_percentage/100);
        $amount = $amount-$loyalty_bonus;

        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->description = "binary bonus from: ".$this->from." to: ".$this->to;
        $payment->amount = $amount;
        $payment->currency_id = $user->currency_id;
        $payment->bonus_type = "binary";
        $payment->status   ="pending";
        $payment->date_time_to_pay = date('Y-m-d H:i:s', strtotime('today 23:50'));
        $payment->save();

        $details = "Loyalty Binary bonus from User :".$user->username;
        Helper::saveLoyaltyBonus($user,$loyalty_bonus, 'binary', $details);
    }

    public function recordBinaryPaymentLogs($user, array $parameter){
            $binarypaymentlog                   = new BinaryPaymentLog();
            $binarypaymentlog->user_id          = $user->id;
            $binarypaymentlog->strong_leg_id    = $parameter['strong_leg_id'];
            $binarypaymentlog->strong_leg_pv    = $parameter['strong_leg_pv'];
            $binarypaymentlog->strong_leg_cf    = $parameter['strong_leg_cf'];

            $binarypaymentlog->weak_leg_id      = $parameter['weak_leg_id'];
            $binarypaymentlog->weak_leg_pv      = $parameter['weak_leg_pv'];
            $binarypaymentlog->weak_leg_cf      = $parameter['weak_leg_cf'];

            $binarypaymentlog->match_sv_used    = $parameter['match_sv_used'];
            $binarypaymentlog->no_of_match      = $parameter['no_of_match'];
            $binarypaymentlog->pv_to_amount     = $parameter['pv_to_amount'];
            $binarypaymentlog->estimate_earning = $parameter['estimate_earning'];
            $binarypaymentlog->earning          = $parameter['estimate_earning'] - ($parameter['estimate_earning']*($this->loyalty_bonus_percentage/100));
            $binarypaymentlog->save();
        }

    public function updateAwardPVColumn($user, $weakLegIndex,$match){
        if($weakLegIndex==0){  // weak leg (paying leg) if left
            $user->award_pv_left += $match*$this->matchSV;
            $user->save();
        }else{
            $user->award_pv_right+= $match*$this->matchSV;
            $user->save();
        }

    }


}
