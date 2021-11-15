<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesPriceQuotationSignature extends Model
{
    use HasFactory;
    protected $table = 'invoices_price_quotation_signature';
    protected $fillable = [
        'user_id',
        'title',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
