<?php

namespace App\Http\Controllers;

use App\Mail\PinRequested;
use App\Models\Package;
use App\Models\Pin;
use App\Models\PinRequest;
use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class UserPinController extends Controller
{
    public function index(Request $request){

        $epins = Pin::where('owner_id', Auth::user()->id)
                      ->with('package')
                      ->get();
        return Inertia::render('Pin/Index', [
            'pageTitle'=>"epins",
            'epins'=>$epins,
            'user'=>Auth::user(),
        ]);
    }

    public function UsedPin(){
        $epins = Pin::where('owner_id', Auth::user()->id)
            ->with('package')
            ->where('status', 1)
            ->get();
        return Inertia::render('Pin/Index', [
            'pageTitle'=>"epins",
            'epins'=>$epins,
            'user'=>Auth::user(),
        ]);
    }

    public function RequestPin(){
        $user_id = Auth::user()->id;

        $pinRequests   =  PinRequest::where('user_id', $user_id)
                                ->with('package', 'currency')
                                ->get();
        $packages = Package::with('price')->get();

        return Inertia::render('Pin/Request', [
            'pageTitle'=>"epins Request",
            'pinRequests'=>$pinRequests,
            'packages'=>$packages,
            'user'=>Auth::user(),
        ]);
    }

    public function StoreRequestPin(Request $request){

        $rules = [
            'package_id'    => 'required',
            'quantity'      => 'required',
            'amount_paid'   => 'required',
            'payment_mode'  => 'required',
            'account_number'=> 'required',
            'bank'          => 'required',
        ];
        $this->validate($request, $rules);

        $user = Auth::user();

        //request file if exist
        $image_url="";
        if($request->transaction_teller){
            $original_name = trim($request->transaction_teller->getClientOriginalName());
            $original_name = str_replace(".".$request->transaction_teller->extension(), "", $original_name);
            $imageName = time()."_".$original_name.'.'.$request->transaction_teller->extension();
            $request->transaction_teller->move(public_path('images/payment_proof'), $imageName);
            $image_url  = "/images/payment_proof/".$imageName;
        }


        $newPinRequest = new PinRequest();
        $newPinRequest->user_id             = $user->id;
        $newPinRequest->package_id          = $request->package_id;
        $newPinRequest->currency_id         = $request->currency_id;
        $newPinRequest->status              = 'pending';
        $newPinRequest->quantity            = $request->quantity;
        $newPinRequest->amount_paid         = $request->amount_paid;
        $newPinRequest->payment_mode        = $request->payment_mode;
        $newPinRequest->account_number      = $request->account_number;
        $newPinRequest->bank                = $request->bank;
        $newPinRequest->payment_details     = $request->payment_details;
        $newPinRequest->transaction_teller  = $image_url;
        $newPinRequest->save();

        $newPinRequest->load('package', 'currency');

        // TODO send notification to user and admin
        Mail::to($user)->queue(new PinRequested($newPinRequest, $user));
        // send queue email to all admin
        $systemAdmins = User::where('type',User::ADMIN_USER)->pluck('email');
        foreach ($systemAdmins as $recipient) {
            Mail::to($recipient)
                ->queue(new PinRequested($newPinRequest, $user));
        }
        return redirect('pin')->with(['success'=>'Request Sent! ' ]);
    }



    public function PinReportRx(){
        $user_id = Auth::user()->id;
        $pinRequests   =  PinRequest::where('user_id', $user_id)
            ->with('package', 'currency')
            ->get();
        $packages = Package::with('price')->get();
        return Inertia::render('Pin/Report', [
            'pageTitle'=>"epins Request",
            'pinRequests'=>$pinRequests,
            'packages'=>$packages,
            'user'=>Auth::user(),
        ]);

    }


}
