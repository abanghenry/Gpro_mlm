<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusBinary extends Model
{
    use HasFactory;

    protected $appends = ['earned_date', 'paid_date'];

    public function getEarnedDateAttribute()
    {
        return Carbon::parse($this->date_time_earned)->format('d M Y');
    }

    public function getPaidDateAttribute()
    {
        return Carbon::parse($this->date_time_paid)->format('M j, Y');
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referred()
    {
      return $this->belongsTo(User::class, 'referral_id');
    }


}
