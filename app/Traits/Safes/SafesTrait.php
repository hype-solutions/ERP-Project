<?php

namespace App\Traits\Safes;

use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait SafesTrait
{
    // public function allSafes(){
    //     return Safes::all();
    // }

    // public function getBranchLinkedSafeId($branchId){
    //     return Safes::where('branch_id', $branchId)->value('id');
    // }

    // public function safeIncrement($safeId, $amount){
    //     return Safes::where('id', $safeId)->increment('safe_balance', $amount);
    // }

    // public function safeDecrement($safeId, $amount){
    //     return Safes::where('id', $safeId)->decrement('safe_balance', $amount);
    // }

    // public function safeTransactionIn($safeId, $amount, $desc){
    //     $payment = new SafesTransactions();
    //     $payment->safe_id = $safeId;
    //     $payment->transaction_type = 2;
    //     $payment->transaction_amount = $amount;
    //     $payment->transaction_datetime = Carbon::now();
    //     $payment->done_by = Auth::id();
    //     $payment->authorized_by = Auth::id();
    //     $payment->transaction_notes = $desc;
    //     $payment->save();
    //     return $payment->id;
    // }

    // public function safeTransactionOut(){

    // }
}
