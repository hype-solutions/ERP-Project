<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesOrdersProducts extends Model
{
    use HasFactory;
    protected $table = 'purchases_orders_products';
    protected $fillable = [
        'purchase_id',
        'supplier_id',
        'product_id',
        'product_desc',
        'product_price',
        'product_qty',
        'status',
    ];
}
