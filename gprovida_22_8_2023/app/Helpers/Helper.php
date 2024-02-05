<?php

namespace App\Helpers;

use App\Models\BonusLoyalty;
use App\Models\Currency;
use App\Models\User;

class Helper
{

    public function __construct(){

    }

    static function  convertToDifferentCurrency($amount, Currency $currencyFrom, Currency $currencyTo){
        if($currencyFrom->id == $currencyTo->id){
            return $amount;
        }
        $baseCurrency = Currency::where('base',1)->first(); // get base currency
        if(!$baseCurrency){
            throw new \Exception('Base currency not found');
        }
        return  ($amount*$currencyFrom->baseRate)/$currencyTo->baseRate;
    }

    static function  convertToDefaultCurrency($amount, Currency $currencyFrom){
        $defaultCurrency = Currency::where('base',1)->first();
        if(!$defaultCurrency){
            throw new \Exception('Base currency not found');
        }
        if($currencyFrom->id == $defaultCurrency->id){
            return $amount;
        }

        return  ($amount*$currencyFrom->baseRate);
    }

    static function saveLoyaltyBonus($user, $amount, $source, $detail){
        $sponsor = User::with('currency')->find($user->referred_by);
        if($sponsor){
            $loyaltyBonus = new BonusLoyalty();
            $loyaltyBonus->user_id          = $sponsor->id; // owner of the bonus
            $loyaltyBonus->referral_id      = $user->id;  // generator of the bonus
            $loyaltyBonus->currency_id      = $user->currency->id;
            $loyaltyBonus->currency_code    = $user->currency->code;
            $loyaltyBonus->amount           = Helper::convertToDifferentCurrency($amount,$user->currency, $sponsor->currency);
            $loyaltyBonus->date_time_earned = date("Y-m-d H:i:s");
            $loyaltyBonus->source           = $source;
            $loyaltyBonus->status           = 0;
            $loyaltyBonus->details          = $detail;
            $loyaltyBonus->save();
        }else{
            // TODO return the money back to the user, if need be
        }
    }

}
