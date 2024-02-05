<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BonusBinary;
use App\Models\BonusDirectPurchase;
use App\Models\BonusReferral;
use Illuminate\Http\Request;

class BonusController extends Controller
{

    public function referral(){
        $referralPVs = BonusReferral::with(['user','currency'])->orderBy('id', 'desc')->get();
        return view('admin.bonus.referral')->with([
            'pageTitle' => "Referral Bonus",
            'referralPVs' => $referralPVs,
        ]);
    }

    public function binary(){
        $bonusBinaries = BonusBinary::with(['user'])->orderBy('id', 'desc')->get();
        return view('admin.bonus.binary')->with([
            'pageTitle' => "Bonus Binaries",
            'bonusBinaries' => $bonusBinaries,
        ]);
    }

    public function directrepurchase(){
        $bonusDirectPurchases = BonusDirectPurchase::with(['user'])->orderBy('id', 'desc')->get();
        return view('admin.bonus.directrepurchase')->with([
            'pageTitle' => "Bonus Direct Purchases",
            'bonusDirectPurchases' => $bonusDirectPurchases,
        ]);
    }
}
