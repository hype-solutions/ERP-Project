<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesPriceQuotationsProducts extends Model
{
    use HasFactory;
    protected $table = 'invoices_price_quotation_products';
    protected $fillable = [
        'quotation_id',
        'customer_id',
        'product_id',
        'product_temp',
        'product_desc',
        'product_price',
        'product_qty',
        'status',
    ];
    public function product()
    {
        return $this->hasOne('App\Models\Products\Products', 'id', 'product_id');
    }
    public function check()
    {
        return $this->hasOne('App\Models\Branches\BranchesProducts', 'product_id', 'product_id')->where('branch_id', '=', 1);
    }
}
