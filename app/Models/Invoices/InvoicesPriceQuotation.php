<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesPriceQuotation extends Model
{
    use HasFactory;
    protected $table = 'invoices_price_quotation';
    protected $fillable = [
        'customer_id',
        'quotation_date',
        'quotation_tax',
        'discount_amount',
        'discount_percentage',
        'discount_reason',
        'shipping_fees',
        'quotation_total',
        'quotation_note',
        'quotation_status',
        'invoice_id',
        'sold_by',
        'authorized_by',
    ];

    public function customer()
    {
        return $this->hasOne('App\Models\Customers\Customers', 'id', 'customer_id');
    }


    public function is_string_float($string) {
    if(is_numeric($string)) {
      $val = $string+0;
      return is_float($val);
    } else {
      return false;
    }
 }
}
