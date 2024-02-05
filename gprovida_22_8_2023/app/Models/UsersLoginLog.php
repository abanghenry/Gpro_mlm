<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersLoginLog extends Model
{
    use HasFactory;


    protected $appends = ['login_date'];

    public function getLoginDateAttribute()
    {
        return $this->created_at->format('M j, Y'); //date_time
    }

}
