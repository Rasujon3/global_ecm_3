<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'variants' => 'array',
    ];

    public function orderdetail()
    {
    	return $this->belongsTo(Orderdetail::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public function getVariantDetailsAttribute()
    {
        $variantIds = $this->variants;

        if (is_string($variantIds)) {
            $variantIds = json_decode($variantIds, true);
        }

        if (empty($variantIds) || !is_array($variantIds)) {
            return [];
        }

        return DB::table('productvariants as pv')
            ->join('variants as v', 'pv.variant_id', '=', 'v.id')
            ->whereIn('pv.id', $variantIds)
            ->select('v.variant_name', 'pv.variant_value')
            ->get();
    }
}
