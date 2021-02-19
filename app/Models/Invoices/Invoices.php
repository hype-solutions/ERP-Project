<?php

namespace App\Models\Invoices;

use App\Traits\Branches\BranchesTrait;
use App\Traits\Customers\CustomersTrait;
use App\Traits\Products\ProductsTrait;
use App\Traits\Safes\SafesTrait;
use App\Traits\Users\UsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    use BranchesTrait, SafesTrait, CustomersTrait, ProductsTrait, UsersTrait;
    protected $table = 'invoices';
    protected $fillable = [
        'customer_id',
        'branch_id',
        'invoice_paper_num',
        'safe_id',
        'safe_transaction_id',
        'invoice_date',
        'invoice_tax',
        'discount_amount',
        'discount_percentage',
        'discount_reason',
        'shipping_fees',
        'invoice_total',
        'invoice_cost',
        'invoice_note',
        'payment_method',
        'already_paid',
        'was_price_quotation',
        'price_quotation_id',
        'sold_by',
        'authorized_by',
    ];

    //Relations
    #Each invoice has one customer
    public function customer()
    {
        return $this->hasOne('App\Models\Customers\Customers', 'id', 'customer_id');
    }

    #Each invoice has one safe
    public function safe()
    {
        return $this->hasOne('App\Models\Safes\Safes', 'id', 'safe_id');
    }

    #Each invoice has one branch
    public function branch()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_id');
    }

    #Invoice products list
    public function productsInInvoice()
    {
        return $this->hasMany('App\Models\Invoices\InvoicesProducts', 'invoice_id', 'id');
    }

    #Invoice later dates list
    public function datesInInvoice()
    {
        return $this->hasMany('App\Models\Invoices\InvoicesPayments', 'invoice_id', 'id');
    }

    //check later
    public function payments()
    {
        return $this->hasMany('App\Models\Invoices\InvoicesPayments', 'invoice_id', 'id');
    }
}
