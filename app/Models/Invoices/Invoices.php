<?php

namespace App\Models\Invoices;

use App\Models\Branches\Branches;
use App\Models\Customers\Customers;
use App\Models\Products\Products;
use App\Models\Safes\Safes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Invoices extends Model
{
    use HasFactory;
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

    public function customer()
    {
        return $this->hasOne('App\Models\Customers\Customers', 'id', 'customer_id');
    }

    public function safe()
    {
        return $this->hasOne('App\Models\Safes\Safes', 'id', 'safe_id');
    }

    public function branch()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_id');
    }

    public function productInInvoice()
    {
        return $this->hasMany('App\Models\Invoices\InvoicesProducts', 'invoice_id', 'id');
    }

    //check later
    public function payments()
    {
        return $this->hasMany('App\Models\Invoices\InvoicesPayments','invoice_id','id');
    }














public function getCurrentUserId(){
    return Auth::id();
}

public function getCustomersList(){
    return Customers::all();
}

public function getProductsList(){
    return Products::all();
}

public function getBranchesList(){
    return Branches::all();
}

public function getSafesList(){
    return Safes::all();
}









}

