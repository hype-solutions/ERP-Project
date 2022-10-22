<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ins\CreateIns;
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
        return view('ins.add', compact('cats', 'safes'));
    }


    public function store(CreateIns $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $in = new In();
        $in->category = $request->cat_id;
        $in->amount = $request->amount;
        $in->notes = $request->notes;
        $in->safe_id = $request->safe_id;
        $in->safe_transaction_id = 0;
        $in->transaction_datetime = Carbon::now();
        $in->done_by = $userId;
        $in->save();

        return redirect()->route('ins.list');
    }


    public function authorizeIn(Request $request, In $in, $code)
    {
        $user = Auth::user();
        $userId = $user->id;
        if ($code == 1) {
            $payment = new SafesTransactions();
            $payment->safe_id = $in->safe_id;
            $payment->transaction_type = 2;
            $payment->direct = 0;
            $payment->transaction_amount = $in->amount;
            $payment->transaction_datetime = Carbon::now();
            $payment->done_by = $userId;
            $payment->authorized_by = $userId;
            $payment->transaction_notes = $in->notes;
            $payment->save();

            $paymentId = $payment->id;
            $in->safe_transaction_id = $paymentId;
            $in->authorized_by = $userId;
            $in->save();

            Safes::where('id', $in->safe_id)->increment('safe_balance', $in->amount);
        } else {
            $in->rejected_by = $userId;
            $in->save();
        }
        return back();
    }

    public function updateCat(InCategories $cat, Request $request)
    {
        $cat->category_name = $request->category_name;
        $cat->save();
        return redirect()->route('ins.categories');
    }

    public function deleteCat(InCategories $cat)
    {
        InCategories::destroy($cat->id);
        return redirect()->route('ins.categories');
    }

    public function categoriesstore(Request $request)
    {
        $cat = new InCategories();
        $cat->category_name = $request->category_name;
        $cat->save();
        return redirect()->back();
    }
}
