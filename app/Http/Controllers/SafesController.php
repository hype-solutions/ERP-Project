<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Safes\ExternalFund;
use Illuminate\Http\Request;

use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Safes\SafesTransfers;
use App\Models\Settings\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SafesController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate(
            [
                'safe_name' => 'unique:safes',
                'safe_balance' => '',
                'branch_id' => '',

            ],
            [
                'safe_name.unique' => 'توجد خزنة مسبقة بنفس هذا الاسم',
            ]
        );
    }
    protected function validateUpdateRequest()
    {
        return request()->validate(
            [
                'safe_name' => '',
                'safe_balance' => '',
                'branch_id' => '',
            ]
        );
    }


    public function deposit(Safes $safe)
    {
        return view('safes.deposit', compact('safe'));
    }
    public function depositing(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $payment = new SafesTransactions();
        $payment->safe_id = $request->safe_id;
        $payment->transaction_type = 2;
        $payment->direct = 1;
        $payment->transaction_amount = $request->amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $user_id;
        $payment->authorized_by = $user_id;
        $payment->transaction_notes = $request->notes;
        $payment->save();
        Safes::where('id', $request->safe_id)->increment('safe_balance', $request->amount);

        return back()->with('success', 'deposited');
    }
    public function withdraw(Safes $safe)
    {
        return view('safes.withdraw', compact('safe'));
    }
    public function withdrawing(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $payment = new SafesTransactions();
        $payment->safe_id = $request->safe_id;
        $payment->transaction_type = 1;
        $payment->direct = 1;
        $payment->transaction_amount = $request->amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $user_id;
        $payment->authorized_by = $user_id;
        $payment->transaction_notes = $request->notes;
        $payment->save();
        Safes::where('id', $request->safe_id)->decrement('safe_balance', $request->amount);
        return back()->with('success', 'withdrawed');
    }

    public function add()
    {
        return view('safes.add');
    }

    public function store()
    {
        Safes::create($this->validatePostRequest());
        return back()->with('success', 'safe Added');
    }

    public function view(Safes $safe)
    {
        $safe_id = $safe->id;
        $branch = Branches::where('id', $safe_id)->get();
        $safeTransfers = SafesTransfers::where('transfer_amount', '>', 0)
            ->where(function ($q) use ($safe_id) {
                $q
                    ->where('safe_from', $safe_id)
                    ->orWhere('safe_to', $safe_id);
            })
            ->with('safeFrom')
            ->with('safeTo')
            ->get();
        $safeTransactions = SafesTransactions::where('safe_id', $safe_id)->get();
        return view('safes.profile', compact('safe', 'branch', 'safeTransfers', 'safeTransactions'));
    }
    public function edit(Safes $safe)
    {
        $safe = Safes::find($safe);
        return view('safes.edit', compact('safe'));
    }

    public function update(Safes $safe)
    {
        $safe->update($this->validateUpdateRequest());
        return back()->with('success', 'safe Updated');
    }

    public function delete(Safes $safe)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $getSafe = Safes::find($safe->id);
        $safeBalance = $getSafe->safe_balance;
        $safeName = $getSafe->safe_name;

        //Get main branch details
        $mainBranch = Branches::first();
        $mainBranchId = $mainBranch->id;

        $getMainSafe = Safes::where('branch_id', $mainBranchId)->first();
        $mainSafeId = $getMainSafe->id;
        $mainSafeBalance = $getMainSafe->safe_balance;
        $totalNew = $mainSafeBalance + $safeBalance;
        $getMainSafe->safe_balance = $totalNew;
        $getMainSafe->save();


        $transfer = new SafesTransfers;
        $transfer->safe_from = $safe->id;
        $transfer->transfer_amount = $safeBalance;
        $transfer->amount_before_transfer_from = $safeBalance;
        $transfer->amount_after_transfer_from = 0;
        $transfer->safe_to = $mainSafeId;
        $transfer->amount_before_transfer_to = $mainSafeBalance;
        $transfer->amount_after_transfer_to = $totalNew;
        $transfer->transfer_datetime = Carbon::now();
        $transfer->transfer_notes = 'عملية تحويل رصيد خزنة بسبب حذفها - اسم الخزنة قبل الحذف ' . $safeName;
        $transfer->transfered_by = $user_id;
        $transfer->authorized_by = $user_id;
        $transfer->save();

        Safes::destroy($safe->id);
        return redirect('/safes')->with('success', 'safe Deleted');
    }

    public function safesList()
    {
        $safes = Safes::all();
        return view('safes.list', compact('safes'));
    }

    // public function transactions()
    // {
    //     $safeTransactions = SafesTransactions::all();
    //     return view('safes.transactions',compact('safeTransactions'));
    // }

    public function transfer()
    {
        $safes = Safes::get();
        $otherSafes = Safes::get();
        $user = Auth::user();
        $user_id = $user->id;
        return view('safes.transfer', compact('safes', 'user_id', 'otherSafes'));
    }

    public function transfering(Request $request)
    {
        SafesTransfers::create($request->all());
        return redirect()->route('safes.list');
    }

    public function acceptingTransfer(SafesTransfers $transfer)
    {

        $update_old_safe = Safes::find($transfer->safe_from);
        $update_old_safe->safe_balance = $update_old_safe->safe_balance - $transfer->transfer_amount;
        // $update_old_safe->safe_balance = $transfer->safeFrom->safe_balance - $transfer->transfer_amount;
        $update_old_safe->save();
        $update_new_safe = Safes::find($transfer->safe_to);
        $update_new_safe->safe_balance = $update_new_safe->safe_balance + $transfer->transfer_amount;
        // $update_new_safe->safe_balance = $transfer->safeTo->safe_balance + $transfer->transfer_amount;
        $update_new_safe->save();
        $transfer->authorized_by = Auth::id();
        $transfer->save();

        return redirect()->route('safes.list');
    }

    public function fetchAmount(Request $request)
    {
        $safe_id = $request->safe;
        $safes = Safes::find($safe_id);
        $amount = $safes->safe_balance;
        return response()->json(array('amount' => $amount), 200);
    }

    public function fetchOtherSafes(Request $request)
    {
        $other_id = $request->other_id;

        $otherSafes = Safes::where('id', '!=', $other_id)->get();
        return $otherSafes;
    }

    public function receipt(SafesTransactions $transactionId)
    {
        $logo = Settings::where('key', 'logo')->value('value');

        return view('safes.receipt', compact('transactionId','logo'));
    }

    public function transferReceipt(SafesTransfers $transferId)
    {
        $logo = Settings::where('key', 'logo')->value('value');

        return view('safes.transferReceipt', compact('transferId','logo'));
    }

    public function externalFund(Safes $safe)
    {
        return view('safes.externalFund', compact('safe'));
    }

    public function externalFunding(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $fund = ExternalFund::create([
            'safe_id' => $request->safe_id,
            'investor' => $request->investor,
            'amount' => $request->amount,
            'funding_date' => Carbon::now(),
            'refund_date' => $request->refund_date,
            'notes' => $request->notes,
            'done_by' => $user_id,
            'authorized_by' => $user_id,
        ]);


        $payment = new SafesTransactions();
        $payment->safe_id = $request->safe_id;
        $payment->transaction_type = 2;
        $payment->direct = 0;
        $payment->transaction_amount = $request->amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $user_id;
        $payment->authorized_by = $user_id;
        $payment->transaction_notes = 'تمويل خارجي على خزنة, رقم ايصال التمويل ' . $fund->id;
        $payment->save();
        Safes::where('id', $request->safe_id)->increment('safe_balance', $request->amount);

        return back()->with('success', 'funded');
    }
}
