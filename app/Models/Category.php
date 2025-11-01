<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_name',
        'status',
        'is_top',
        'is_featured',
        'is_homepage',
        'image'
    ];

    // public function brands()
    // {
    //     return $this->belongsToMany(Brand::class, 'brand_category');
    // }

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
    	return $this->hasMany(Subcategory::class);
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }
}
