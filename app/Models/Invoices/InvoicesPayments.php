<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesPayments extends Model
{
    use HasFactory;
    protected $table = 'invoices_payments';
    protected $fillable = [
        'customer_id',
        'invoice_id',
        'amount',
        'date',
        'notes',
        'paid',
        'safe_id',
        'safe_payment_id'
    ];
}
