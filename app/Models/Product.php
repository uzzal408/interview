<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function varient_price()
    {
        return $this->hasMany(ProductVariantPrice::class);
    }

}
