<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Pin;
use App\Models\PinRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PinRequestController extends Controller
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
                    $pin_requests = PinRequest::where('status','pending')->with(['currency','user', 'package'])->get();
                    break;
                case 'approved':
                    $pin_requests = PinRequest::where('status','approved')->with(['currency','user', 'package'])->get();
                    break;
                case 'cancelled':
                    $pin_requests = PinRequest::where('status','cancelled')->with(['currency','user', 'package'])->get();
                    break;
                default:
                    $pin_requests = PinRequest::with(['currency','user', 'package'])->get();
            }
        }else{
            $pin_requests = PinRequest::with(['currency','user', 'package'])->get();
        }

        return view('admin.pin.request.index')->with([
            'pageTitle' => "Pin Request",
            'pin_requests' => $pin_requests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/pinrequest');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('admin/pinrequest');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pin_request = PinRequest::with('user','package','currency')->find($id);
        if(!$pin_request){
            return redirect('admin/pinrequest')->with(['error'=>'Request not found']);
        }

        return view('admin.pin.request.edit')->with([
            'pageTitle' => "process Pin Request",
            'pin_request'=>$pin_request,
        ]);

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
            'pinRequestID' => 'required',
            'task' => 'required',
        ];

        $this->validate($request, $rules);
        $pin_request = PinRequest::with('package')->find($id);

        if($request->task =="cancel" && $pin_request->status=="pending"){
            $pin_request->status ="cancelled";
            $pin_request->save();
            return redirect('admin/pinrequest')->with(['status'=>'Request Cancelled' ]);
        }elseif ($request->task =="approve" && $pin_request->status=="pending"){
            $pin_request->status ="approved";
            $pin_request->save();
            $number =$pin_request->quantity;
            for($i=0; $i<$number; $i++){
                try{
                    $pin = mt_rand(100000000, 999999999);
                    $newPin                 = new Pin();
                    $newPin->owner_id       = $pin_request->user_id;
                    $newPin->pin_request_id = $pin_request->id;
                    $newPin->pin_number     = $pin;
                    $newPin->package_id     = $pin_request->package_id;
                    $newPin->status         = "0";
                    $newPin->used_for       = null;
                    $newPin->package_name   = $pin_request->package->name;
                    $newPin->save();
                }catch (Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        $number = $number+1; // discard and continue
                    }
                }
            }

            return redirect('admin/pinrequest')->with(['status'=>'Pin Generated successfully' ]);
        }else{
            return redirect('admin/pinrequest')->with(['status'=>'Unknow Task' ]);
        }







    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
