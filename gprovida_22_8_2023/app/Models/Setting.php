<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public function getTextAttribute()
    {
        return ucwords(str_replace("_"," ", $this->key));
    }

    public function getOptionsarrayAttribute(){
        return $optionsArray = explode(',', trim($this->options));
    }
}
