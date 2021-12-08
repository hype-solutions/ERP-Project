<?php

namespace App\Models\PurchasesOrders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesOrdersPayments extends Model
{
    use HasFactory;
    protected $table = 'purchases_orders_payments';
    protected $fillable = [
        'supplier_id',
        'purchase_id',
        'amount',
        'date',
        'date_collected',
        'notes',
        'paid',
        'safe_id',
        'safe_payment_id'
    ];

    public function safe()
    {
        return $this->hasOne('App\Models\Safes\Safes', 'id', 'safe_id');
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
