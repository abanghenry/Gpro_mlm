<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('admin.currency.index')->with([
            'pageTitle' => "currencies",
            'currencies' => $currencies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255|unique:currencies',
            'code' => 'required|max:255|unique:currencies',
            'prefix' => 'required',
            'BaseRate' => 'required',
            'pv_rate' => 'required',
          ];

          $this->validate($request, $rules);

        $currency = new Currency;
        $currency->name     = $request->name;
        $currency->code     = $request->code;
        $currency->prefix   = $request->prefix;
        $currency->suffix   = $request->suffix;
        $currency->format   = $request->currency_format;
        if($request->BaseRate==0){
           $currency->BaseRate = 1.00;
        }else{
            $currency->BaseRate = $request->BaseRate;
        }
        $currency->pv_rate = $request->pv_rate;
        $currency->base   = 0;
        $currency->save();

        $currencies = Currency::all();
        return redirect('admin/currency')->with(['status'=>'Currency Added successfully' ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::find($id);
        return view('admin.currency.edit')->with('currency', $currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'code' => 'required',
            'prefix' => 'required',
            'BaseRate' => 'required',
            'pv_rate' => 'required',
          ];

          $this->validate($request, $rules);

          $currency = Currency::find($id);
          $currency->name     = $request->name;
          $currency->code     = $request->code;
          $currency->prefix   = $request->prefix;
          $currency->suffix   = $request->suffix;
          $currency->format   = $request->currency_format;
          if($request->BaseRate==0){
             $currency->BaseRate = 1.00;
          }else{
              $currency->BaseRate = $request->BaseRate;
          }
          $currency->pv_rate = $request->pv_rate;

          $currency->save();

          return redirect('admin/currency')->with(['status'=>'Currency updated successfully' ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message="";
        $currency = currency::find($id);
        if($currency){
            $currency->delete();
            $message="Currency deleted successfully";
        }
        return redirect('admin/currency')->with(['status'=>$message]);
    }
}
