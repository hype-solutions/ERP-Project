<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable =
    [
        'product_code',
        'product_category',
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

    public function cat()
    {
        return $this->hasOne('App\Models\Products\ProductsCategories','id','product_category');
    }

    public function purchasesOrders()
    {
        return $this->belongsTo('App\Models\PurchasesOrders\PurchasesOrdersProducts','id','product_id')->where('status','Delivered')->avg('product_price');
    }

}
