<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Support extends Model
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
        return base64_encode($this->ticket_id );
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    public function children(){
        return $this->hasMany(Support::class,'parent_id', 'id');
    }




}
