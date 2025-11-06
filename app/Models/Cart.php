<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $casts = [
        'productvariant_ids' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productvariant()
    {
        return $this->belongsTo(Productvariant::class);
    }
    public function productVariants()
    {
        return $this->hasMany(Productvariant::class, 'product_id', 'product_id')
            ->whereIn('id', $this->productvariant_ids ?? []);
    }
    public function getVariantDetailsAttribute()
    {
        $variantIds = $this->productvariant_ids;

        // Handle cases where it’s a JSON string or null
        if (is_string($variantIds)) {
            $variantIds = json_decode($variantIds, true);
        }

        if (empty($variantIds) || !is_array($variantIds)) {
            return [];
        }

        // Convert all to integers (for strict match in DB)
        $variantIds = array_map('intval', $variantIds);

        return \DB::table('productvariants as pv')
            ->join('variants as v', 'pv.variant_id', '=', 'v.id')
            ->whereIn('pv.id', $variantIds)
            ->select('v.variant_name', 'pv.variant_value')
            ->get();
    }

}
