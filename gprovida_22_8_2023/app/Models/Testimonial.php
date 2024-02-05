<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $appends = ['created_date'];

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('M j, Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
