<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;



    protected $appends = ['updated_date'];


    public function getUpdatedDateAttribute()
    {
        return $this->updated_at?->format('M j, Y') ;
    }


}
