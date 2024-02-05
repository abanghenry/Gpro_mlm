<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\ProductInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        $currencies = Currency::all();
        return view('admin.package.index')->with([
            'pageTitle' => "Packages",
            'packages' => $packages,
            'currencies' => $currencies
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
            'name' => 'required|max:255|unique:products',
            'referral_bonus' => 'required|max:255|numeric',
            'pv' => 'required|numeric',
            'type' => 'required',
            'featured_image' => 'required|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
            'NGN' => 'required',
            'capping_NGN' => 'required',
            'GBP' => 'required',
            'capping_GBP' => 'required',
            'USD' => 'required',
            'capping_USD' => 'required',
            'EUR' => 'required',
            'capping_EUR' => 'required',
        ];

        $customMessages = [
            'NGN.required' => 'Price in Naira is require.',
            'GBP.required' => 'Price in Pounds is require.',
            'USD.required' => 'Price in US Dollars is require.',
            'EUR.required' => 'Price in Euro is require.',
            'capping_NGN.required' => 'Capping in Naira is require.',
            'capping_GBP.required' => 'Capping in Pounds is require.',
            'capping_USD.required' => 'Capping in US Dollars is require.',
            'capping_EUR.required' => 'Capping in Euro is require.',
        ];

        $this->validate($request, $rules, $customMessages);

        //store image
        $original_name = trim($request->featured_image->getClientOriginalName());
        $original_name = str_replace(".".$request->featured_image->extension(), "", $original_name);
        $imageName = time()."_".$original_name.'.'.$request->featured_image->extension();
        $request->featured_image->move(public_path('images/package'), $imageName);

        $package = new Package();
        $package->name           = $request->name;
        $package->description    = $request->description;
        $package->type           = $request->type;
        $package->referral_bonus = $request->referral_bonus;
        $package->pv             = $request->pv;
        $package->image          = "/images/package/".$imageName;
        $package->status         = $request->status;
        $package->save();

        //create price
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $code  =$currency->code;
            $price = $request->$code;
            $capping_name = "capping_".$code;
            $capping = $request->$capping_name;

            $packagePrice = new PackagePrice;
            $packagePrice->package_id    = $package->id;
            $packagePrice->currency_id   = $currency->id;
            $packagePrice->currency_code = $currency->code;
            $packagePrice->price         = $price ;
            $packagePrice->capping       = $capping;

            $packagePrice->save();
        }

        return redirect('admin/package')->with(['status'=>'Package Added successfully' ]);
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
        $package = Package::with('price')->find($id);
        $currentPrices = $package->price->pluck('price', 'currency_code'); //toArray();
        $currentCappings = $package->price->pluck('capping', 'currency_code'); //toArray();


        $currencies = Currency::all();
        return view('admin.package.edit')->with([
            'pageTitle' => "Edit Packages",
            'package' => $package,
            'currencies' => $currencies,
            'currentPrices' => $currentPrices,
            'currentCappings' => $currentCappings
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
            'name' => 'required|max:255|unique:products,name,' . $id,
            'referral_bonus' => 'required|numeric',
            'pv' => 'required|numeric',
        ];
        $this->validate($request, $rules);

        $package = Package::find($id);
        $package->name           = $request->name;
        $package->description    = $request->description;
        $package->type           = $request->type;
        $package->referral_bonus = $request->referral_bonus;
        $package->pv             = $request->pv;
        $package->status         = $request->status;
        $package->save();

        // update image if dirty
        if($request->featured_image){
            $original_name = trim($request->featured_image->getClientOriginalName());
            $original_name = str_replace(".".$request->featured_image->extension(), "", $original_name);
            $imageName = time()."_".$original_name.'.'.$request->featured_image->extension();
            $request->featured_image->move(public_path('images/package'), $imageName);
            $package->image          = "/images/package/".$imageName;
            $package->save();
        }

        //update price
        $currencies = Currency::all();
        foreach ($currencies as $currency) {
            $code  = $currency->code;
            $price = $request->$code;
            $capping_name = "capping_".$code;
            $capping = $request->$capping_name;

            // update inventory
            $packagePrice = PackagePrice::firstOrNew([
                'package_id' =>  $package->id,
                'currency_id' => $currency->id,
            ]);
            if($packagePrice->isClean()){// Existing model
                $packagePrice->price       = floatval($price) ;
                $packagePrice->capping     = floatval($capping);
                $packagePrice->currency_code = $currency->code;
                $packagePrice->save();
            }else{//New
                $packagePrice->package_id  = $package->id;
                $packagePrice->currency_id = $currency->id;
                $packagePrice->currency_code = $currency->code;
                $packagePrice->price       = floatval($price);
                $packagePrice->capping     = floatval($capping);
                $packagePrice->save();
            }
        }
        return redirect('admin/package')->with(['status'=>'Package Updated  successfully' ]);

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
        $package = Package::find($id);
        if($package){
            $package->delete();
            $message="Package deleted successfully";
        }
        return redirect('admin/package')->with(['status'=>$message]);

    }
}
