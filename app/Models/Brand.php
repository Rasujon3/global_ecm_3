<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_name',
        'status',
        'is_mega_menu',
        'image'
    ];


    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'brand_category');
    // }
}
