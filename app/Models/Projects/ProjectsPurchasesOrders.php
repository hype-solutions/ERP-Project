<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsPurchasesOrders extends Model
{
    use HasFactory;
    protected $table = 'projects_purchases_orders';
    protected $fillable = [
        'project_id',
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
        'added_by',
        'autherized_by',
    ];
}

