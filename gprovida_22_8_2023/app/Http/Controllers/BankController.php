<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BitCoin;
use App\Models\Currency;
use App\Models\NigeriaBank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Webpatser\Countries\Countries;

class BankController extends Controller
{

    public function bank(){
        $banks = Bank::where('user_id',Auth::user()->id)
                       ->with('currency')
                       ->get();
        $currencies = Currency::all();
        $countries = Countries::orderBy('name')->get();
        $nigeriaBanks = NigeriaBank::orderBy('name')->get(['name','code','bank_code','country']);

        return Inertia::render('Account/Bank', [
            'banks'=>$banks,
            'currencies'=>$currencies,
            'countries'=>$countries,
            'user'=>Auth::user(),
            'nigeriaBanks'=>$nigeriaBanks
        ]);

    }


    public function bankStore(Request $request){
        $rules = [
            'currency_id' => 'required',
            'bank_name' => 'required',
            'bank_holder_name' => 'required',
            'bank_account_number' => 'required',
            'country' => 'required',
            'status' => 'required',
            'sort_code' => 'required',
            'bank_code' => 'required',
        ];
        $this->validate($request, $rules);

        // TODO check for foreign(USD, EUR) and request for swift
        $bank = new Bank();
        $bank->user_id              = Auth::user()->id;
        $bank->currency_id          = $request->currency_id;
        $bank->bank_name            = $request->bank_name;
        $bank->bank_holder_name     = $request->bank_holder_name;
        $bank->bank_account_number  = $request->bank_account_number;
        $bank->bank_branch          = $request->bank_branch;
        $bank->country              = $request->country;
        $bank->type                 = $request->type;
        $bank->swift                = $request->swift;
        $bank->bic                  = $request->bic;
        $bank->sort_code            = $request->sort_code;
        $bank->bank_code            = $request->bank_code;
        $bank->routing_no           = $request->routing_no;
        $bank->status               = $request->status;
        if($request->default == 1){
            DB::table('banks')->where('user_id', Auth::user()->id)->update(['default' => 0]);
            $bank->default   = $request->default;
        }
        // if first account make it the default
        $usersAccount = Bank::where('user_id',Auth::user()->id)->get();


        if($usersAccount->count()==0){
            $bank->default   = 1;
        }

        $bank->save();
        return redirect('/bank')->with(['success'=>'Bank Added successfully' ]);
    }


    public function bankUpdate(Request $request){
        $rules = [
            'id'=>'required',
            'currency_id' => 'required',
            'bank_name' => 'required',
            'bank_holder_name' => 'required',
            'bank_account_number' => 'required',
            'country' => 'required',
            'status' => 'required',
            'sort_code' => 'required',
            'bank_code' => 'required',
        ];
        $this->validate($request, $rules);

        $bank =Bank::find($request->id);
        $bank->currency_id          = $request->currency_id;
        $bank->bank_name            = $request->bank_name;
        $bank->bank_holder_name     = $request->bank_holder_name;
        $bank->bank_account_number  = $request->bank_account_number;
        $bank->bank_branch          = $request->bank_branch;
        $bank->country              = $request->country;
        $bank->type                 = $request->type;
        $bank->swift                = $request->swift;
        $bank->bic                  = $request->bic;
        $bank->sort_code            = $request->sort_code;
        $bank->bank_code            = $request->bank_code;
        $bank->routing_no           = $request->routing_no;
        $bank->status               = $request->status;
        if($request->default == 1){
			//DB::table('banks')->where('user_id', Auth::user()->id)->update(['default' => 0]);
            $bank->default   = $request->default;
        }
        $bank->save();
        return redirect('/bank')->with(['success'=>'Bank Updated successfully' ]);

    }




}
