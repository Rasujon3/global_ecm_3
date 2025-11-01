<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    use HasFactory;

    protected $table = 'intros';

    protected $fillable = [
        'icon',
        'title',
        'price',
        'description'
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
