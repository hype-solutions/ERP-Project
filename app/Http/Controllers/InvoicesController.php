<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoices\AddInvoice;
use App\Models\Branches\BranchesProducts;
use App\Models\ERPLog;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Invoices\InvoicesProducts;
use App\Models\Products\Products;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Settings\Settings;
use App\Traits\ERPLogTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    use ERPLogTrait;
    protected $invoice;
    public function __construct(Invoices $invoice)
    {
        $this->middleware('installed');
        $this->middleware('auth');
        $this->invoice = $invoice;
    }

    public function add()
    {
        $invoice = $this->invoice;
        return view('invoices.add', compact('invoice'));
    }


    public function view($invoiceId)
    {
        $invoice = $this->invoice->find($invoiceId);
        $this->addLogRecord('Invoices', 'View', $invoiceId);
        $logo = Settings::where('key', 'logo')->value('value');
        $company = Settings::where('key', 'company_name')->value('value');
        $addressLineOne = Settings::where('key', 'address_1')->value('value');
        $addressLineTwo = Settings::where('key', 'address_2')->value('value');

        return view('invoices.profile', compact('company', 'logo', 'invoice', 'addressLineOne', 'addressLineTwo'));
    }


    public function print2($invoiceId)
    {
        $invoice = $this->invoice->find($invoiceId);
        $p = 2;
        $template = 0;
        $this->addLogRecord('Invoices', 'Print', $invoiceId);
        return view('invoices.print', compact('p', 'template', 'invoice'));
    }


    public function print3($invoiceId, Request $request)
    {
        $invoice = $this->invoice->find($invoiceId);
        $p = 3;
        $template = $request->template;
        $this->addLogRecord('Invoices', 'Print', $invoiceId);
        return view('invoices.print', compact('p', 'template', 'invoice'));
    }


    public function edit($invoiceId)
    {
        $invoice = $this->invoice->find($invoiceId);
        $this->addLogRecord('Invoices', 'View', $invoiceId);
        return view('invoices.edit', compact('invoice'));
    }

    public function invoicesList()
    {
        $invoices = $this->invoice->all();
        $this->addLogRecord('Invoices', 'View', '0');
        $logo = Settings::where('key', 'logo')->value('value');

        return view('invoices.list', compact('logo', 'invoices'));
    }


    public function store(AddInvoice $request)
    {
        $data = $request->validated();
        $safeId = $this->invoice->getBranchLinkedSafeId($data['branch_id']);
        $customerId = $this->invoice->checkIfCustomerIsNewAndAdd($data['new_customer_name'], $data['new_customer_mobile'], $data['customer_id']);
        if ($data['payment_method'] != 'later') {
            $alreadyPaid = 1;
            $paymentId = $this->invoice->safeTransactionIn($safeId, $data['invoice_total'], '');
            $this->invoice->safeIncrement($safeId, $data['invoice_total']);
        } else {
            $alreadyPaid = 0;
            $paymentId = 0;
            $safeId = 0;
        }

        $invoice = new Invoices();
        $invoice->customer_id = $customerId;
        $invoice->invoice_paper_num = $data['invoice_paper_num'];
        $invoice->branch_id = $data['branch_id'];
        $invoice->invoice_note = $data['invoice_note'];
        $invoice->discount_percentage = $data['discount_percentage'];
        $invoice->discount_amount = $data['discount_amount'];
        $invoice->invoice_tax = $data['tax'];
        $invoice->payment_method = $data['payment_method'];
        $invoice->invoice_date = Carbon::now();
        $invoice->invoice_total = $data['invoice_total'];
        $invoice->shipping_fees = $data['shipping_fees'];
        $invoice->already_paid = $alreadyPaid;
        $invoice->safe_id = $safeId;
        $invoice->safe_transaction_id = $paymentId;
        $invoice->sold_by = $data['sold_by'];
        $invoice->authorized_by = $data['sold_by'];
        $invoice->save();

        $invoiceId = $invoice->id;
        if ($data['payment_method'] != 'later') {
            $this->invoice->updateSafeTransactionAddDesc($paymentId);
        } else {
            foreach ($data['later'] as $item) {
                $this->invoice->addInvoiceInstallment(
                    $safeId,
                    $invoiceId,
                    $customerId,
                    $item['amount'],
                    $item['date'],
                    $item['notes'],
                    isset($item['paynow']) ? $item['paynow'] : ''
                );
            }
        }

        //Save Items
        foreach ($data['product'] as $item) {
            $invoice->productIncrementOut($item['id'], $item['qty']);
            $invoice->decrementProductInBranch($item['id'], $data['branch_id'], $item['qty']);
            $invoice->insertProductIntoInvoice($invoiceId, $customerId, $item['id'], $item['desc'], $item['price'], $item['cost'], $item['qty']);
        }
        $sumCost = $invoice->getInvoiceCostSum();
        $invoice->updateInvoiceCost($sumCost);
        $this->addLogRecord('Invoices', 'Add', $invoiceId);
        return redirect('/invoices')->with('success', 'invoice added');
    }






    public function update(Request $request, $invoice)
    {
        // Get Branch Safe ID
        $safeId = Safes::where('branch_id', $request->branch_id)->value('id');
        //Get invoice data and update it
        $invoice = Invoices::find($invoice);
        $invoice->customer_id = $request->customer_id;
        $invoice->branch_id = $request->branch_id;
        $invoice->invoice_note = $request->invoice_note;
        $invoice->discount_percentage = $request->discount_percentage;
        $invoice->invoice_tax = $request->tax;
        $invoice->invoice_paper_num = $request->invoice_paper_num;

        $invoice->discount_amount = $request->discount_amount;
        $invoice->payment_method = $request->payment_method;
        $invoice->invoice_date = Carbon::now();
        $invoice->invoice_total = $request->invoice_total;
        $invoice->shipping_fees = $request->shipping_fees;
        $invoice->sold_by = $request->sold_by;
        $invoice->authorized_by = $request->sold_by;

        //If already paid is checked
        if ($request->already_paid == 'on') {
            //If the invoice is paid before
            if ($invoice->already_paid > 0) {
                //Do nothing
            } else {
                $invoice->safe_id = $request->safe_id_not_paid;
                $payment = new SafesTransactions();
                $payment->safe_id = $request->safe_id_not_paid;
                $payment->transaction_type = 2;
                $payment->transaction_amount = $request->invoice_total;
                $payment->transaction_notes = 'فاتورة مبيعات رقم  ' . $invoice;
                $payment->transaction_datetime = Carbon::now();
                $payment->done_by = 1;
                $payment->authorized_by    = 1;
                $payment->save();
                $paymentId = $payment->id;
                $invoice->safe_transaction_id = $paymentId;
                $invoice->already_paid = 1;
                Safes::where('id', $safeId)->increment('safe_balance', $request->invoice_total);
            }
        } else {
            $invoice->safe_transaction_id = null;
            $invoice->safe_id = null;
            $invoice->already_paid = 0;
        }
        $invoice->save();

        //Assigning variable to use
        $invoiceId = $invoice->id;
        $product = $request->product;
        $date = $request->later;
        $customerId = $request->customer_id;

        //Save Items
        foreach ($product as $item) {
            //Updating stock
            Products::where('id', $item['id'])
                ->increment('product_total_out', $item['qty']);
            BranchesProducts::where('product_id', $item['id'])
                ->where('branch_id', $request->branch_id)
                ->decrement('amount', $item['qty']);
        }
        //Delete old records
        InvoicesProducts::where('invoice_id', $invoiceId)->delete();
        //Save new records
        $listOfProducts = [];
        foreach ($product as $item) {
            $pro = new InvoicesProducts();
            $pro->invoice_id = $invoiceId;
            $pro->customer_id = $customerId;
            $pro->product_id = $item['id'];
            $pro->product_desc = $item['desc'];
            $pro->product_price = $item['price'];
            $pro->product_cost = $item['cost'] * $item['qty'];
            $pro->product_qty = $item['qty'];
            $pro->status = 'shipped';
            $pro->save();
            $listOfProducts[] = $pro;
        }


        if ($invoice->payment_method == 'later') {
            //Delete old payment records
            InvoicesPayments::where('invoice_id', $invoiceId)->delete();
            //Save new payment records
            $listOfDates = [];
            foreach ($date as $item) {
                $da = new InvoicesPayments();
                $da->invoice_id = $invoiceId;
                $da->customer_id = $customerId;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];
                //If paynow is checked
                if (!empty($item['paynow'])) {
                    //If the user has paid before and transaction id is saved
                    if (!empty($item['safe_payment_id'])) {
                        $da->paid = 'Yes';
                        $da->safe_payment_id = $item['safe_payment_id'];
                        $da->safe_id = $safeId;
                    } else {
                        $da->paid = 'Yes';
                        $payment = new SafesTransactions();
                        $payment->safe_id = $safeId;
                        $payment->transaction_type = 1;
                        $payment->transaction_amount = $item['amount'];
                        $payment->transaction_datetime = Carbon::now();
                        $payment->done_by = $request->sold_by;
                        $payment->authorized_by = $request->sold_by;
                        $payment->transaction_notes = 'قسط على فاتورة رقم' . $invoiceId;
                        $payment->save();
                        $paymentId = $payment->id;
                        $da->safe_id = $safeId;
                        $da->safe_payment_id = $paymentId;
                        Safes::where('id', $safeId)->decrement('safe_balance', $item['amount']);
                        Invoices::where('id', $invoiceId)->increment('amount_collected', $item['amount']);
                    }
                } else {
                    $da->paid = 'No';
                }
                $da->save();
                $listOfDates[] = $da;
            }
            $checkAllPaid = InvoicesPayments::where('invoice_id', $invoiceId)
                ->where('paid', 'No')
                ->count();
            if ($checkAllPaid > 0) {
                Invoices::where('id', $invoiceId)->update(['already_paid' => 0]);
            } else {
                Invoices::where('id', $invoiceId)->update(['already_paid' => 1]);
            }
        }
        $sumCost = InvoicesProducts::where('invoice_id', $invoiceId)->sum('product_cost');
        $edtInvoice = Invoices::find($invoiceId);
        $edtInvoice->invoice_cost = $sumCost;
        $edtInvoice->save();
        ERPLog::create(['type' => 'Invoices', 'action' => 'Edit', 'custom_id' => $invoiceId, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);

        return back();
    }

    public function refunds()
    {
        $sessions = Invoices::where('already_paid', 1)->get();
        Carbon::setlocale("ar");

        return view('invoices.refunds', compact('sessions'));
    }

    public function refundsSearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $invoices = Invoices::where("id", "LIKE", "%{$request->search}%")
                ->where('already_paid', 1)
                ->get();
            if ($invoices) {
                foreach ($invoices as $invoice) {
                    $output .= '<tr>' .
                        '<td><h3><b>' . $invoice->id . '</b></h3></td>' .
                        '<td>' . $invoice->sell_user->username . '</td>' .
                        '<td>' . $invoice->branch->branch_name . '</td>';
                    if ($invoice->customer) {
                        $output .=
                        '<td>' . $invoice->customer->customer_name . '</td>';
                    } else {
                        $output .=
                        '<td><span class="info">زائر</span></td>';
                    }
                    $output .=
                        '<td>' . $invoice->invoice_date . '</td>' .
                        '<td>' . $invoice->invoice_total . '</td>' .
                        '<td><button class="btn btn-success btn-sm">إختر</button></td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }
}
