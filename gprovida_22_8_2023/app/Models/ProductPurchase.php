<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPurchase extends Model
{
    use HasFactory, SoftDeletes;

    public function supplier()
    {
        return $this->belongsTo(ProductSupplier::class);
    }

    public function product()
    {
       return $this->belongsTo(Product::class);
    }

    public function store()
    {
       return $this->belongsTo(Store::class);
    }

}
