<?php

namespace App\Http\Controllers;

use App\Models\ERPLog;
use App\Models\Invoices\Invoices;
use App\Models\Invoices\InvoicesPayments;
use App\Models\PurchasesOrders\PurchasesOrders;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\Safes\ExternalFund;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstallmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    public function installments()
    {
        $invoicePayments = InvoicesPayments::where('paid', 'No')->get();
        $purchasesOrdersPayments = PurchasesOrdersPayments::where('paid', 'No')->get();
        $externalFund = ExternalFund::where('paid', 'No')->get();

        return view('installments.landing', compact('invoicePayments', 'purchasesOrdersPayments', 'externalFund'));
    }

    public function payment($type, $id)
    {
        if ($type == 1) {
            $ins = InvoicesPayments::find($id);
            $safes = Safes::all();
        } else if ($type == 2) {
            $ins = PurchasesOrdersPayments::find($id);
            $safes = Safes::where('safe_balance', '>=', $ins->purchase->purchase_total)->get();
        } else if ($type == 3) {
            $ins = ExternalFund::find($id);
            $safes = Safes::where('safe_balance', '>=', $ins->amount)->get();
        }

        if ($ins->paid == 'Yes') {
            return back();
        }

        return view('installments.pay', compact('ins', 'safes', 'type'));
    }


    public function payNow(Request $request)
    {
        if ($request->installment_type == 'invoice') {
            $var = 2;
        } else if ($request->installment_type == 'po') {
            $var = 1;
        } else if ($request->installment_type == 'external') {
            $var = 1;
        }

        $user = Auth::user();
        $user_id = $user->id;
        $payment = new SafesTransactions();
        $payment->safe_id = $request->safe_id;
        $payment->transaction_type = $var;
        $payment->transaction_amount = $request->amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $user_id;
        $payment->authorized_by = $user_id;
        $payment->transaction_notes = $request->notes;
        $payment->save();

        if ($request->installment_type == 'invoice') {
            InvoicesPayments::where('id', $request->installment_invoice)->update([
                'paid' => 'Yes',
                'safe_id' => $request->safe_id,
                'safe_payment_id' => $payment->id,
                'date_collected' => Carbon::now(),
            ]);
            $invoice = Invoices::find($request->invoice_id);
            Safes::where('id', $request->safe_id,)->increment('safe_balance', $request->amount);
            ERPLog::create(['type' => 'Installment', 'action' => 'Add', 'custom_id' => $payment->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);
            $installmentsCount = InvoicesPayments::where('invoice_id', $invoice->id)->where('paid', 'No')->count();
            if ($installmentsCount <= 0) {
                Invoices::where('id', $invoice->id)->update(['already_paid' => 1]);
            }
        } else if ($request->installment_type == 'po') {
            PurchasesOrdersPayments::where('id', $request->installment_invoice)->update([
                'paid' => 'Yes',
                'safe_id' => $request->safe_id,
                'safe_payment_id' => $payment->id,
                'date_collected' => Carbon::now(),
            ]);
            $purchase = PurchasesOrders::find($request->purchase_id);
            $installmentsCount = PurchasesOrdersPayments::where('purchase_id', $purchase->id)->where('paid', 'No')->count();
            if ($installmentsCount <= 0) {
                PurchasesOrders::where('id', $purchase->id)->update([
                    'already_paid' => 1,
                    'purchase_status' => 'Paid'
                ]);
            }
            Safes::where('id', $request->safe_id,)->decrement('safe_balance', $request->amount);
            ERPLog::create(['type' => 'Installment', 'action' => 'Add', 'custom_id' => $payment->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);
        } else if ($request->installment_type == 'external') {
            ExternalFund::where('id', $request->installment_invoice)->update([
                'paid' => 'Yes',
                'safe_id' => $request->safe_id,
                'safe_payment_id' => $payment->id,
                'date_payed' => Carbon::now(),
            ]);
            // $invoice->safeIncrement($request->safe_id, $request->amount);
            Safes::where('id', $request->safe_id,)->decrement('safe_balance', $request->amount);
            ERPLog::create(['type' => 'Installment', 'action' => 'Add', 'custom_id' => $payment->id, 'user_id' => Auth::id(), 'action_date' => Carbon::now()]);
        }
        return redirect()->route('installments.landing')->with('success', 'deposited');
    }
}
