<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable =
    [
        'product_code',
        'procuct_category',
        'product_sub_category',
        'product_name',
        'product_price',
        'product_total_in',
        'product_total_out',
        'product_desc',
        'product_brand',
        'product_track_stock',
        'product_low_stock_thershold',
        'product_notes',
    ];

}
