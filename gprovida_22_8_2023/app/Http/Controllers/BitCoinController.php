<?php

namespace App\Http\Controllers;

use App\Models\BitCoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BitCoinController extends Controller
{

    public function bitcoin(){
        $bitcoins = BitCoin::where('user_id',Auth::user()->id)->get();
        return Inertia::render('Account/Bitcoin', [
            'bitcoins'=>$bitcoins,
        ]);
    }


    public function bitcoinStore(Request $request){
        $rules = [
            'bit_address' => 'required',
            'status' => 'required',
        ];
        $this->validate($request, $rules);

        $bitCoin = new BitCoin();
        $bitCoin->user_id     = Auth::user()->id;
        $bitCoin->bit_address = $request->bit_address;
        $bitCoin->status      = $request->status;

        if($request->default == 1){
            DB::table('bit_coins')->update(['default' => 0]);
            $bitCoin->default   = $request->default;
        }
        $bitCoin->save();
        return redirect('/bitcoin')->with(['success'=>'bitcoin Added successfully' ]);
    }


    public function bitcoinUpdate(Request $request){
        $rules = [
            'id'=>'required',
            'bit_address' => 'required',
            'status' => 'required',
        ];
        $this->validate($request, $rules);

        $bitCoin =BitCoin::find($request->id);
        $bitCoin->bit_address = $request->bit_address;
        $bitCoin->status      = $request->status;
        if($request->default == 1){
            DB::table('bit_coins')->update(['default' => 0]);
            $bitCoin->default   = $request->default;
        }
        $bitCoin->save();
        return redirect('/bitcoin')->with(['success'=>'bitcoin Updated successfully' ]);

    }

}
