<?php

namespace App\Models\Invoices;
#Models

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use App\Models\Customers\Customers;
use App\Models\Products\Products;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\User;
#Traits
use Carbon\Carbon;
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

    public function sell_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'sold_by');
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


    // public function addInvoiceTransaction($safeId, $invoiceTotal){
    //         $payment = SafesTransactions::create([
    //         'safe_id' => $safeId,
    //         'transaction_type' => 2,
    //         'transaction_amount' => $invoiceTotal,
    //         'transaction_datetime' => Carbon::now(),
    //         'done_by' => $this->loggedInUserId(),
    //         'authorized_by' => $this->loggedInUserId(),
    //     ]);
    //     return $payment->id;
    // }

    public function productIncrementOut($productId, $amount)
    {
        return Products::where('id', $productId)->increment('product_total_out', $amount);
    }

    public function decrementProductInBranch($productId, $branchId, $amount)
    {
        return BranchesProducts::where('product_id', $productId)
            ->where('branch_id', $branchId)
            ->decrement('amount', $amount);
    }



    public function insertProductIntoInvoice($invoiceId, $customerId, $pId, $pDesc, $pPrice, $pCost, $pQty)
    {
        $pro = new InvoicesProducts();
        $pro->invoice_id = $invoiceId;
        $pro->customer_id = $customerId;
        $pro->product_id = $pId;
        $pro->product_desc = $pDesc;
        $pro->product_price = $pPrice;
        $pro->product_cost = $pCost * $pQty;
        $pro->product_qty = $pQty;
        $pro->status = 'shipped';
        $pro->save();
    }

    public function getInvoiceCostSum()
    {
        InvoicesProducts::where('invoice_id', $this->id)->sum('product_cost');
    }

    public function updateInvoiceCost($sumCost)
    {
        Invoices::find($this->id)->update([
            'invoice_cost' => $sumCost,
        ]);
    }


    public function updateSafeTransactionAddDesc($paymentId)
    {
        $edtPayment = SafesTransactions::find($paymentId);
        $edtPayment->transaction_notes = 'فاتورة مبيعات رقم  ' . $this->invoice;
        $edtPayment->save();
    }

    public function addInvoiceInstallment($safeId, $invoiceId, $customerId, $amount, $date, $notes, $paynow)
    {
        $da = new InvoicesPayments();
        $da->invoice_id = $invoiceId;
        $da->customer_id = $customerId;
        $da->amount = $amount;
        $da->date = $date;
        $da->notes = $notes;
        if (!empty($paynow)) {
            $da->paid = 'Yes';
            //pay here
            $payment_id = $this->safeTransactionIn($safeId, $amount, 'قسط على فاتورة رقم' . $invoiceId);
            $da->safe_id = $safeId;
            $da->safe_payment_id = $payment_id;
            $this->safeIncrement($safeId, $amount);
            Invoices::where('id', $invoiceId)->increment('amount_collected', $amount);
        } else {
            $da->paid = 'No';
        }
        $da->save();
    }

    public function createCustomer($name, $mobile)
    {
        $newCustomer = Customers::create(['customer_name' => $name, 'customer_mobile' => $mobile]);
        return $newCustomer->id;
    }


    public function checkIfCustomerIsNewAndAdd($name, $mobile, $checkId)
    {
        if ($name != '') {
            $customerId = $this->createCustomer($name, $mobile);
        } else {
            $customerId = $checkId;
        }
        return $customerId;
    }

    public function allCustomers()
    {
        return Customers::all();
    }

    public function allSafes()
    {
        return Safes::all();
    }

    public function getBranchLinkedSafeId($branchId)
    {
        return Safes::where('branch_id', $branchId)->value('id');
    }

    public function safeIncrement($safeId, $amount)
    {
        return Safes::where('id', $safeId)->increment('safe_balance', $amount);
    }

    public function safeDecrement($safeId, $amount)
    {
        return Safes::where('id', $safeId)->decrement('safe_balance', $amount);
    }

    public function safeTransactionIn($safeId, $amount, $desc)
    {
        $payment = new SafesTransactions();
        $payment->safe_id = $safeId;
        $payment->transaction_type = 2;
        $payment->transaction_amount = $amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = Auth::id();
        $payment->authorized_by = Auth::id();
        $payment->transaction_notes = $desc;
        $payment->save();
        return $payment->id;
    }

    public function safeTransactionOut()
    {
    }

    public function allBranches()
    {
        return Branches::all();
    }

    public function allProducts()
    {
        return Products::all();
    }

    public function allUsers()
    {
        return User::all();
    }

    public function loggedInUserId()
    {
        return Auth::id();
    }
}
