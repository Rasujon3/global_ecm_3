<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'unit_id',
        'brand_id',
        'product_name',
        'status',
        'image',
        'discount',
        'product_price',
        'stock_qty',
        'description',
        'is_best_seller',
        'is_arrival_product',
        'tag',
    ];


    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function unit()
    {
    	return $this->belongsTo(Unit::class);
    }

    public function productvariants()
    {
    	return $this->hasMany(Productvariant::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function whishlist()
    {
        return $this->hasOne(Whishlist::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}


