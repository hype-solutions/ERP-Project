<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branches;
use App\Models\Safes;
use App\Models\BranchesProducts;

class BranchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate([
            'branch_name' => 'required|max:255',
            'branch_mobile' => 'required|unique:branches',
            'branch_phone' => '',
            'branch_address' => '',
            'branch_email' => '',
        ],
        [
            //'branch_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
            'branch_mobile.required' => 'برجاء إدخال رقم موبايل الفرع',
            'branch_mobile.unique' => 'هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر',
        ]
    );
    }


    protected function validateUpdateRequest()
    {
        return request()->validate([
            'branch_name' => 'required',
            'branch_mobile' => 'required',
            'branch_phone' => '',
            'branch_address' => '',
            'branch_email' => '',
        ],
        [
            //'branch_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
            'branch_mobile.required' => 'برجاء إدخال رقم موبايل الفرع',
        ]
    );
    }
    public function add()
    {
        return view('branches.add');
    }

    public function store()
    {
        $branch = Branches::create($this->validatePostRequest());
        $safe = new Safes;
        $safe->safe_name = $branch->branch_name;
        $safe->branch_id = $branch->id;
        $safe->safe_balance = 0;
        $safe->save();
        return back()->with('success', 'Branch Added');
    }

    public function view(Branches $branch)
    {
        $branch = Branches::find($branch);
        $branch_id = $branch[0]->id;
        $safe = Safes::where('branch_id',$branch_id)->get();
        $safeBalance = $safe[0]->safe_balance;
        $products = BranchesProducts::where('branch_id',$branch_id)
                                    ->where('amount','!=',0)
                                    ->with('product')->get();

 return view('branches.profile',compact('branch','safeBalance','products'));
    }
    public function edit(Branches $branch){
        $branch = Branches::find($branch);
        return view('branches.edit',compact('branch'));
    }

    public function update(Branches $branch)
    {
        $branch->update($this->validateUpdateRequest());

        $branchDetails = Branches::find($branch);
        $branch_id = $branchDetails[0]->id;
        $branch_name = $branchDetails[0]->branch_name;
        $safe = Safes::where('branch_id',$branch_id)->first();
        $safe->safe_name = $branch_name;
        $safe->save();
        return back()->with('success', 'Branch Updated');
    }

    public function delete(Branches $branch)
    {
        Branches::destroy($branch->id);
        Safes::where('branch_id',$branch->id)->delete();
        return redirect('/branches')->with('success', 'Branch Deleted');
    }

    public function branchesList()
    {
        $branches = Branches::all();
        return view('branches.list',compact('branches'));
    }
}
