<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Pin;
use App\Models\User;
use Illuminate\Http\Request;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->status){
            $status = $request->status;
            switch ($status){
                case 'pending':
                    $pins = Pin::where('status','0')
                                ->orderBy('id', 'DESC')
                                ->with(['owner','user', 'package'])->get();
                    break;
                case 'used':
                    $pins = Pin::where('status','1')
                                ->orderBy('id', 'DESC')
                                ->with(['owner','user', 'package'])->get();
                    break;
                case 'cancelled':
                    $pins = Pin::where('status','2')
                                ->orderBy('id', 'DESC')
                                ->with(['owner','user', 'package'])->get();
                    break;
                case 'assigned':
                    $pins = Pin::whereNotNull('owner_id')
                                ->orderBy('id', 'DESC')
                                ->with(['owner','user', 'package'])->get();
                    break;
                default:
                    $pins = Pin::with(['owner','user', 'package'])->orderBy('id', 'DESC')->get();
            }
        }else{
            $pins = Pin::with(['owner','user', 'package'])->orderBy('id', 'DESC')->get();
        }

        return view('admin.pin.index')->with([
            'pageTitle' => "Pins",
            'pins' => $pins,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all();
        $users = User::all();
        return view('admin.pin.create')->with([
            'pageTitle' => "Pins",
            'packages' => $packages,
            'users' =>$users,
        ]);
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
            'pin_count' => 'required|max:255',
            'package' => 'required',
        ];
        $this->validate($request, $rules);
        $number   =  $request->pin_count;
        $package  =  Package::find($request->package);
        $user     =  $request->user;

        for($i=0; $i<$number; $i++){
            try{
                $pin = mt_rand(100000000, 999999999);
                $newPin                = new Pin();
                $newPin->owner_id      = $user;
                $newPin->pin_number    = $pin;
                $newPin->package_id    = $package->id;
                $newPin->status        = "0";
                $newPin->used_for      = null;
                $newPin->package_name  = $package->name;
                $newPin->save();
            }catch (Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    $number = $number+1; // discard and continue
                }
            }
        }

        return redirect('admin/pin')->with(['status'=>'Pin Generated successfully' ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('admin/pin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('admin/pin');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('admin/pin');
    }
}
