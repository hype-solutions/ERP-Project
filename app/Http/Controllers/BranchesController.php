<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branches\CreateBranch;
use App\Http\Requests\Branches\UpdateBranch;
use App\Models\Branches\Branches;
use App\Models\Safes\Safes;

class BranchesController extends Controller
{

    protected $branch;

    public function __construct(Branches $branch)
    {
        $this->middleware('installed');
        $this->middleware('auth');
        $this->branch = $branch;
    }


    public function add()
    {
        return view('branches.add');
    }


    public function store(CreateBranch $request)
    {
        $data = $request->validated();
        $branch = $this->branch->create($data);
        $branch->createSafe($branch->branch_name);
        $branch->setBranchAllowedProducts();

        return back()->with('success', 'Branch Added');
    }


    public function edit(Branches $branch)
    {
        return view('branches.edit', compact('branch'));
    }


    public function update(Branches $branch, UpdateBranch $request)
    {
        $data = $request->validated();
        $branch->fill($data);
        return back()->with('success', 'Branch Updated');
    }


    public function delete($branchId)
    {
        $branchData = $this->branch->find($branchId);
        $branchData->beginBranchDeleteProccess();
        return redirect('/branches')->with('success', 'Branch Deleted');
    }


    public function branchesList()
    {
        $branches = $this->branch->all();
        return view('branches.list', compact('branches'));
    }


    public function view($branchId)
    {
        $branchData = $this->branch->findOrFail($branchId);
        $safeBalance = $branchData->getBranchSafeDetails()->value('safe_balance');
        $branchProducts = $branchData->branchProductsinStock();
        $productsCount = $branchData->branchProductsinStockCount();

        return view('branches.profile', compact(
            'productsCount',
            'branchData',
            'safeBalance',
            'branchProducts'
        ));
    }
}
