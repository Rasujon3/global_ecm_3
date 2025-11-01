<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'variant_name',
        'status',
    ];

    public function productvariants()
    {
    	return $this->hasMany(Productvariant::class);
    }
}
