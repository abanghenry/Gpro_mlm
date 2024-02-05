<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserActivated;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Jobs\ProcessUserActivationBonus;
use App\Models\Currency;
use App\Models\Package;
use App\Models\Pin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $currency= null;
        if ($position = Location::get()) {
            if ($position->countryCode) {
                $country = DB::table('countries')
                    ->where("iso_3166_2", $position->countryCode)
                    ->first();
                if ($country) {
                    $currency = Currency::where('code', $country->currency_code)
                        ->first();
                }
            }
        }
        if(!$currency){
            $currency = Currency::where('code', "NGN")->first();
        }



        $countries = DB::table('countries')->get();
        $packages = Package::with('priceDefault')->where('type','!=','stockist')->get();

        return view('auth.register')->with([
            'countries' => $countries,
            'packages' => $packages,
            'currency' => $currency,
        ]);

//        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255', //
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'package' => 'required',
            'payment' => 'required',
            'currency_id' => 'required|string|max:255',
        ]);

       // verify epin
       $usercontroller = new UserController();
       if($request->payment =="epin"){

           $pin_details = Pin::where('pin_number', $request->epin)->where('status', '0')->first();
           if(!$pin_details){
               return redirect('/genealogy')->with(['error'=>'E-pin is Invalid or used, Confirm and try again']);
           }
           if($pin_details->package_id != $request->package_id){
               return redirect('/genealogy')->with(['error'=>'E-pin is Invalid for selected Package, Confirm and try again']);
           }

           /*
           $pin = $usercontroller->checkPin($request->epin, $request->package);
           if(!$pin){
               return redirect('register')->with(['error'=>'Invalid E-Pin for selected Package, Confirm and try again']);
           }
           */
       }

        // verify referred by
        $sponsor = User::find($request->sponsor);
        if(!$sponsor){
            $sponsor   = User::where('type', '5')->first();
            $request->sponsor = $sponsor->id;
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'gender' => $request->gender,
            'email' => $request->email,
            'profession' => $request->profession,
            'skills' => "",
            'phone' => $request->phone,
            'address' => $request->address,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'referred_by' => $request->sponsor,
            //'parent' => "", //$request->sponsor
            //'position' => $request->position,
            'package_id' => $request->package,
            'payment_method'=> $request->payment,
            'currency_id' => $request->currency_id,
            'active' => 0,
            'type' => 1,
            'registration_pin' => $request->epin,
            'password' => Hash::make($request->password),
        ]);

        // update pin
        if($request->payment =="epin"){
            $pin_details = Pin::where('pin_number', $request->epin)->where('status', '0')->first();
            $usercontroller->updatePinUsed($pin_details, $user);
            // Pin used, Activate user
            $position=""; $parent=$request->sponsor;
            event(new UserActivated($user, $parent, $position));
        }

        event(new Registered($user));

        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }





}
