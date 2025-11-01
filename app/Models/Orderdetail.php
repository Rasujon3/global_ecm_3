<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orderdetail extends Model
{
    use HasFactory;

    protected $casts = [
        'variants' => 'array', // ensures it's decoded automatically
    ];
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function orders()
    {
    	return $this->hasMany(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship to product variants (custom)
    public function productVariants()
    {
        return $this->hasMany(Productvariant::class, 'product_id', 'product_id')
            ->whereIn('id', $this->variants ?? []);
    }
    public function getVariantDetailsAttribute()
    {
        if (empty($this->variants)) {
            return [];
        }

        $variantIds = is_array($this->variants)
            ? $this->variants
            : json_decode($this->variants, true);

        if (empty($variantIds)) {
            return [];
        }

        return \DB::table('productvariants as pv')
            ->join('variants as v', 'pv.variant_id', '=', 'v.id')
            ->whereIn('pv.id', $variantIds)
            ->select('v.variant_name', 'pv.variant_value')
            ->get();
    }
    
    public function paymentmethod()
    {
        return $this->belongsTo(Paymentmethod::class);
    }

}
