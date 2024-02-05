<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Package extends Model
{
    use HasFactory;

    public function price()
    {
        return $this->hasMany(PackagePrice::class);
    }

    public function priceUser()
    {
        $currency_id=1;
        if(Auth::user()){
            $currency_id = Auth::user()->currency_id;
        }
        return $this->price()->where('currency_id','=', $currency_id);
    }

    public function priceCurrency($currency_id){
        return $this->price()->where('currency_id','=', $currency_id)->get();
    }
    public function priceDefault()
    {
        $defaultCurrency = Currency::where('base',1)->first();
        return $this->price()->where('currency_id','=',$defaultCurrency->id);
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($package) { // before delete() method call this
            $package->price()->delete();
        });
    }

}
