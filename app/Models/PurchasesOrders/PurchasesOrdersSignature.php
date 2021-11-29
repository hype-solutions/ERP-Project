<?php

namespace App\Models\PurchasesOrders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesOrdersSignature extends Model
{
    use HasFactory;
    protected $table = 'purchases_orders_signature';
    protected $fillable = [
        'user_id',
        'title',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
