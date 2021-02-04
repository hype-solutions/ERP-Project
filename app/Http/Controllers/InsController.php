<?php

namespace App\Http\Controllers;

use App\Models\In\In;
use App\Models\In\InCategories;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    public function insList()
    {
        $ins = In::all();
        return view('ins.list', compact('ins'));
    }

    public function categories()
    {
        $cats = InCategories::all();
        return view('ins.categories', compact('cats'));
    }


    public function add()
    {
        $cats = InCategories::all();
        $safes = Safes::all();
        return view('ins.add', compact('cats','safes'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $in = new In();
        $in->category = $request->cat_id;
        $in->amount = $request->amount;
        $in->notes = $request->notes;
        $in->safe_id = $request->safe_id;
        $in->safe_transaction_id = 0;
        $in->transaction_datetime = Carbon::now();
        $in->done_by = $user_id;
        $in->authorized_by = $user_id;
        $in->save();
        $inId = $in->id;

        $payment = new SafesTransactions();
        $payment->safe_id = $request->safe_id;
        $payment->transaction_type = 2;
        $payment->direct = 0;
        $payment->transaction_amount = $request->amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $user_id;
        $payment->authorized_by = $user_id;
        $payment->transaction_notes = $request->notes;
        $payment->save();
        $paymentId = $payment->id;

        In::where('id',$inId)->update(['safe_transaction_id' => $paymentId]);
        Safes::where('id', $request->safe_id)->increment('safe_balance', $request->amount);
        return redirect()->route('ins.list');
    }

    public function categoriesstore(Request $request)
    {
         $cat = new InCategories();
         $cat->category_name = $request->category_name;
         $cat->save();
         return redirect()->back();
    }
}
