<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productvariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_id',
        'variant_value',
        'variant_price',
        'stock_qty',
        'image',
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function variant()
    {
    	return $this->belongsTo(Variant::class, 'variant_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
