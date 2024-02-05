<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;


    protected $appends = ['updated_date','created_date', 'encrypted_id'];


    public function getUpdatedDateAttribute()
    {
        return $this->updated_at->format('M j, Y');
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('F j, Y, g:i a');
    }

    public function getEncryptedIdAttribute()
    {
        return base64_encode($this->id );
    }

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
