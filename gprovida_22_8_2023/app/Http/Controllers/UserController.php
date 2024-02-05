<?php

namespace App\Http\Controllers;


use App\Models\Pin;
use Hash;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{


    public function profile(){
        $user =Auth::user();
        return Inertia::render('Profile/View', ['user'=>$user] );
    }

    public function editProfile(){
        $user =Auth::user();
        return Inertia::render('Profile/Edit', [
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ],
        ]);
    }

    public function updatePassword(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            //'password' =>'hash:' . $user->password,
            'password' =>'required',
            'new_password' =>  'required|different:password|confirmed'
        ]);

        if(!Hash::check($request->password, auth()->user()->password)){
            return redirect()->back()->with("error", "Old Password Doesn't match!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Your new password is now set!');
    }



    public function changePassword(){
        $user =Auth::user();
        return Inertia::render('Profile/ChangePassword', ['user'=>$user] );
    }


    public function activateUser(User $user){
        ProcessRegistrationBonus::dispatch();
    }


    public function checkPin($epin, $package){
        $pin_details = Pin::where('pin_number', $epin)->where('status', '0')->first();
        // verify pin
        if ((!$pin_details) || ($pin_details->package_id != $package) ){
            return FALSE;
        } else{
            return TRUE;
        }
    }

    public function checkPinPackage($epin, $package){
        $pin_details = Pin::where('pin_number', $epin)->where('status', '0')->first();
        // verify pin
        if ((!$pin_details) || ($pin_details->package_id != $package) ){
            return FALSE;
        } else{
            return TRUE;
        }
    }

    public function checkPinUser($epin, $package, $user_id){
        $pin_details = Pin::where('pin_number', $epin)
                            ->where('status', '0')
                            ->where(function ($query) use ($user_id) {
                                $query->where('owner_id', $user_id)
                                    ->orWhereNull('owner_id');
                            })
                            ->where('owner_id', $user_id)
                            ->first();
        // verify pin
        if ((!$pin_details) || ($pin_details->package_id != $package) ){
            return FALSE;
        } else{
            return TRUE;
        }

    }


    public function updatePinUsed(Pin $pin, User $used_for){
        $pin->status = 1;
        $pin->used_for = $used_for->id;
        $pin->save();
        return $pin ;
    }


}
