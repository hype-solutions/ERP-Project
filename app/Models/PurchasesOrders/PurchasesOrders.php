<?php

namespace App\Models\PurchasesOrders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesOrders extends Model
{
    use HasFactory;
    protected $table = 'purchases_orders';
    protected $fillable = [
        'supplier_id',
        'purchase_date',
        'discount_percentage',
        'discount_amount',
        'discount_reason',
        'shipping_fees',
        'purchase_tax',
        'purchase_total',
        'purchase_note',
        'purchase_status',
        'already_paid',
        'payment_method',
        'safe_payment_id',
        'safe_id',
        'already_delivered',
        'delivery_date',
        'branch_id',
        'added_by',
        'autherized_by',
    ];

    public function supplier()
    {
        return $this->hasOne('App\Models\Suppliers\Suppliers', 'id', 'supplier_id');
    }

    public function safe()
    {
        return $this->hasOne('App\Models\Safes\Safes', 'id', 'safe_id');
    }


    public function branch()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_id');
    }


    public function productInOrder()
    {
        return $this->hasMany('App\Models\PurchasesOrders\PurchasesOrdersProducts', 'purchase_id', 'id');
    }
}
