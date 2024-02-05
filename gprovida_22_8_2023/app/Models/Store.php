<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Store extends Model
{
    use HasFactory;

    protected $appends = ['encrypted_id'];

    public function managers()
    {
        return $this->hasMany(UserStore::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function getEncryptedIdAttribute()
    {
        //return base64_encode($this->id);
        return  Crypt::encryptString($this->id);
    }


}
