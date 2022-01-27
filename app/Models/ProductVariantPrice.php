<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPrice extends Model
{
    protected $fillable = [
        'product_variant_one','product_variant_two','product_variant_three','stock','price','product_id'
    ];

}
