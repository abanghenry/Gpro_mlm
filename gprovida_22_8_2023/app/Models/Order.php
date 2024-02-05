<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Order extends Model
{
    use HasFactory, SoftDeletes;


    protected $appends = ['order_date','encrypted_id'];

    public function getEncryptedIdAttribute()
    {
        return  Crypt::encryptString($this->id);
    }


    public function getOrderDateAttribute()
    {
        return $this->created_at->format('M j, Y');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }


}
