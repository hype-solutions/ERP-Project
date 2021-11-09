<?php

namespace App\Http\Controllers;

use App\Models\Out\Out;
use App\Models\Out\OutCategories;
use App\Models\Out\OutEntities;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    public function outsList()
    {
        $outs = Out::all();
        return view('outs.list', compact('outs'));
    }

    public function entities()
    {
        $entities = OutEntities::all();
        return view('outs.entities', compact('entities'));
    }

    public function categories()
    {
        $cats = OutCategories::all();
        return view('outs.categories', compact('cats'));
    }



    public function add()
    {
        $cats = OutCategories::all();
        $entities = OutEntities::all();
        $safes = Safes::all();
        return view('outs.add', compact('cats', 'safes', 'entities'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $in = new Out();
        $in->entity = $request->entity_id;
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
        $payment->transaction_type = 1;
        $payment->direct = 0;
        $payment->transaction_amount = $request->amount;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $user_id;
        $payment->authorized_by = $user_id;
        $payment->transaction_notes = $request->notes;
        $payment->save();
        $paymentId = $payment->id;

        Out::where('id', $inId)->update(['safe_transaction_id' => $paymentId]);
        Safes::where('id', $request->safe_id)->increment('safe_balance', $request->amount);
        return redirect()->route('outs.list');
    }


    public function categoriesstore(Request $request)
    {
        $cat = new OutCategories();
        $cat->category_name = $request->category_name;
        $cat->save();
        return redirect()->back();
    }


    public function entitiesstore(Request $request)
    {
        $cat = new OutEntities();
        $cat->entity_name = $request->entity_name;
        $cat->save();
        return redirect()->back();
    }


    public function updateEnt(OutEntities $ent, Request $request)
    {
        $ent->entity_name = $request->entity_name;
        $ent->save();
        return redirect()->route('outs.entities');
    }

    public function deleteEnt(OutEntities $ent)
    {
        OutEntities::destroy($ent->id);
        return redirect()->route('outs.entities');
    }

    public function updateCat(OutCategories $cat, Request $request)
    {
        $cat->category_name = $request->category_name;
        $cat->save();
        return redirect()->route('outs.categories');
    }

    public function deleteCat(OutCategories $cat)
    {
        OutCategories::destroy($cat->id);
        return redirect()->route('outs.categories');
    }
}
