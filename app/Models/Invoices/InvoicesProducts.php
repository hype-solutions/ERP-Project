<?php

namespace App\Models\Invoices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesProducts extends Model
{
    use HasFactory;
    protected $table = 'invoices_products';
    protected $fillable = [
        'invoice_id',
        'customer_id',
        'product_id',
        'product_desc',
        'product_price',
        'product_qty',
        'status',
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Products\Products', 'id', 'product_id');
    }


    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoices\Invoices', 'invoice_id', 'id');
    }
}
