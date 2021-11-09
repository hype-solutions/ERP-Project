<?php

namespace App\Models\PurchasesOrders;

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


    public function product()
    {
        return $this->hasOne('App\Models\Products\Products', 'id', 'product_id');
    }

    public function supplier()
    {
        return $this->hasOne('App\Models\Suppliers\Suppliers', 'id', 'supplier_id');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Models\PurchasesOrders\PurchasesOrders', 'purchase_id', 'id');
    }
}
