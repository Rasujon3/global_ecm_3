<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'logo',
        'favicon',
        'phone',
        'email',
        'address',
        'established',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'pinterest',
        'contact_us_img',
        'inside_dhaka_dc',
        'outside_dhaka_dc',
        'sub_urban_areas_dc',
        'bank_name',
        'branch_name',
        'routing_number',
        'acc_no',
        'bkash_no',
        'account_type',

        'welcome_msg',
        'shop_name',
        'copyright_msg',
        'footer_title',
        'footer_description',

        'meta_pixel_script',
    ];

    protected $casts = [
        'sub_urban_areas_dc' => 'integer',
        'outside_dhaka_dc'   => 'integer',
        'inside_dhaka_dc'    => 'integer',
    ];
}
