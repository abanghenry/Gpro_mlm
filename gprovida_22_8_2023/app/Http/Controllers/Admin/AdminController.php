<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {

        $members = User::all();
        $memberCount = $members->count();
        $packages = Package::all();

        return view('admin/dashboard')
            ->with([
                'members' => $members, 'member_count' => $memberCount, 'pack' => $packages,
                'revenue' => 5000,
                'totalUserBonuses' => 50006,
                'releasedUserBonuses' => 7884,
                'totalPurcahases' => 44000,
                'monthlyPurcahases' => 50000,
                'totalProductPayout' => 700000,
                'monthlyProductPayout' => 600000,
                'companySum' => 80000, 'payoutSum' => 75000,
                'actualPayout' => 500000, 'companyEarnings' => 50000,
                'leadersIncentive' => 52000, 'paidDividends' => 50000,
                'unpaidDividends' => 20000, 'totalInvestments' => 20000,
                'actualDividend' => 500000,
            ]);

    }

}
