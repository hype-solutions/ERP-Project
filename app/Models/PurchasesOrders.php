<?php

namespace App\Models;

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
        'purchase_note',
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
        return $this->hasOne('App\Models\Suppliers', 'id', 'supplier_id');
    }

    public function safe()
    {
        return $this->hasOne('App\Models\Safes', 'id', 'safe_id');
    }


    public function branch()
    {
        return $this->hasOne('App\Models\Branches', 'id', 'branch_id');
    }
}
