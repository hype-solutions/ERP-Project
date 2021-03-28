<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsPurchasesOrdersPayments extends Model
{
    use HasFactory;
    protected $table = 'projects_purchases_orders_payments';
    protected $fillable = [
        'project_id',
        'supplier_id',
        'amount',
        'date',
        'date_collected',
        'notes',
        'paid',
        'safe_id',
        'safe_payment_id',
    ];
}
