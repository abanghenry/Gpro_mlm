<?php

namespace App\Http\Controllers\Admin;

use App\Models\BonusReferral;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\Setting;
use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::with(['managers.user', 'package'])->get();
        $countries = DB::table('countries')->orderBy('name')->get();
        $packages  = Package::where('type','stockist')->get();
        return view('admin.inventory.store.index')->with([
            'pageTitle' => "stores",
            'stores' => $stores,
            'packages' => $packages,
            'countries' => $countries,
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
            'name'    => 'required|max:255|unique:stores',
            'address' => 'required|max:255',
            'city'    => 'required|max:255',
            'state'   => 'required|max:255',
            'country' => 'required|max:255',
            'phone'   => 'required|max:255',
            'managers' => 'required',
            'package_id' => 'required',
          ];

        $this->validate($request, $rules);


        //store image if exist
        $image_url="";
        if($request->banner){
            $original_name = trim($request->banner->getClientOriginalName());
            $original_name = str_replace(".".$request->banner->extension(), "", $original_name);
            $imageName = time()."_".$original_name.'.'.$request->banner->extension();
            $request->banner->move(public_path('images/stores'), $imageName);
            $image_url  = "/images/stores/".$imageName;
        }

          $newStore = new Store;
          $newStore->name        = $request->name;
          $newStore->slug        = $request->name;
          $newStore->package_id  = $request->package_id;
          $newStore->description = $request->description;
          $newStore->address     = $request->address;
          $newStore->address2    = $request->address2;
          $newStore->city        = $request->city;
          $newStore->state       = $request->state;
          $newStore->country     = $request->country;
          $newStore->phone       = $request->phone;
          $newStore->email       = $request->email;
          $newStore->website     = $request->website;
          $newStore->map         = $request->map;
          $newStore->image_url   = $image_url;
          $newStore->save();

          // add store Manager
          foreach ($request->managers as $manager) {
            $newManager = new UserStore;
            $newManager->user_id     = $manager;
            $newManager->store_id    = $newStore->id;
            $newManager->save();
          }

          // add stockist referral bonus
          $manager = User::find($request->managers[0]);
          $this->addStockistReferralBonus($manager, $request->package_id);

       // TODO send notification to admin and manager
       // Grproskills has added you as store Manager of .....store name

       return redirect('admin/store')->with(['status'=>'Store Added successfully' ]);
    }


    public function addStockistReferralBonus(User $manager, $package_id){  //TODO
        $package = Package::find($package_id);
        $package_price = PackagePrice::where('package_id',$package->id)
            ->where('currency_id',$manager->currency_id)
            ->first();

        $referral_bonus_percent = $package->referral_bonus;
        $earned_amount = ($referral_bonus_percent/100)*$package_price->price;
        $sponsor = User::find($manager->referred_by);
        if(!$sponsor){ // if no sponsor
            return;
        }

        $ref_bonus = new BonusReferral();
        $ref_bonus->user_id           = $sponsor->id;
        $ref_bonus->referral_id       = $manager->id; // whose action generated the bonus
        $ref_bonus->currency_id       = $package_price->currency_id;
        $ref_bonus->currency_code     = $package_price->currency_code;
        $ref_bonus->amount            = $earned_amount;
        $ref_bonus->date_time_earned  = date('Y-m-d H:i:s', strtotime('today 23:50'));
        $ref_bonus->source           = "referral_stockist";
        $ref_bonus->status            = 0; // pending
        $ref_bonus->details           = "Stockist Referral bonus earned from user: ".$manager->username;
        $ref_bonus->save();


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
        //
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
        //
    }
}
