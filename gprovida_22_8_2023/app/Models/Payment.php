<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;



    protected $appends = ['due_date', 'paid_date'];

    public function getDueDateAttribute()
    {
        return Carbon::parse($this->date_time_to_pay)->format('M j, Y');
    }

    public function getPaidDateAttribute()
    {
        return Carbon::parse($this->date_time_paid)->format('M j, Y');
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

}
