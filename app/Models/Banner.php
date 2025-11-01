<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'brand_id',
        'title',
        'description',
        'price',
        'image'
    ];


    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'brand_category');
    // }
}
