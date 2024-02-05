<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pin extends Model
{
    use HasFactory, SoftDeletes;


    protected $appends = ['updated_date'];

    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->format('M j, Y');
    }



    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'used_for');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
