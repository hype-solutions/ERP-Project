<?php

namespace App\Models;

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
        'notes',
        'paid',
        'safe_id',
        'safe_payment_id'
    ];

    public function safe()
    {
        return $this->hasOne('App\Models\Safes', 'id', 'safe_id');
    }
}
