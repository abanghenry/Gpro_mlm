<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }

    public function price()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function inventory()
    {
        return $this->hasMany(ProductInventory::class);
    }

    public function meta()
    {
        return $this->hasMany(ProductMeta::class);
    }



    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function tags()
    {
        return $this->hasMany(ProductTage::class);
    }


}
