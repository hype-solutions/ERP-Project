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
        'date_collected',
        'notes',
        'paid',
        'safe_id',
        'safe_payment_id'
    ];


    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoices\Invoices', 'invoice_id', 'id');
    }
}
