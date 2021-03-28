<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsPriceQuotationsPayments extends Model
{
    use HasFactory;
    protected $table = 'projects_price_quotations_payments';
    protected $fillable = [
        'customer_id',
        'project_id',
        'amount',
        'date',
        'date_collected',
        'notes',
        'paid',
        'safe_id',
        'safe_payment_id',
    ];
}
