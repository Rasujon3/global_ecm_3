<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_name',
        'image',
        'is_mega_menu',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
