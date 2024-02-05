<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusLoyalty extends Model
{
    use HasFactory;

    const PENDING = 0;
    const PROCESSING = 1;
    const PAID  =2;

    protected $appends = ['earned_date', 'paid_date'];

    public function getEarnedDateAttribute()
    {
        return Carbon::parse($this->date_time_earned)->format('d M Y');
    }
    public function getPaidDateAttribute()
    {
        return Carbon::parse($this->date_time_paid)->format('d M Y');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'referral_id');
    }

}
