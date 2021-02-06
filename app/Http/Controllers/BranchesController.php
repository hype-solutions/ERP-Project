<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branches\CreateBranch;
use App\Http\Requests\Branches\UpdateBranch;
use Illuminate\Http\Request;
use App\Models\Branches\Branches;
use App\Models\Safes\Safes;
use App\Models\Branches\BranchesProducts;
use App\Models\Products\ProductsTransfers;
use App\Models\Safes\SafesTransfers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        $newBranch = $this->branch->create($data);
        Safes::create(['safe_name' => $newBranch->branch_name,'branch_id' => $newBranch->id]);
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
        foreach ($branchData->branchProductsinStock() as $product) {
            $foundProductAmount = $branchData->branchProductsinStock()
            ->where('product_id', $product->id)->first()->value('amount');

            if ($branchData->checkIfThisProductInMainBranch($product->id)) {
                $branchData->updateMainBranchbeforeDeletingOther($product->id);
            } else {
                $branchData->insertProdutcInMainBranch($product->id, $foundProductAmount);
            }
            $branchData->CreateProductTransferRecord($product->id, $foundProductAmount);
            $branchData->deleteBranchProductsRecords();
        }
            $branchData->transferBalance($branchData->getBranchSafeDetails()->value('safe_balance'));
            $branchData->CreateMoneyTransferRecord(
                $branchData->getBranchSafeDetails()->value('id'),
                $branchData->getBranchSafeDetails()->value('safe_balance')
            );
            $branchData->deleteBranch();
            $branchData->deleteSafe($branchData->getBranchSafeDetails()->value('id'));
            return redirect('/branches')->with('success', 'Branch Deleted');
    }


    public function branchesList()
    {
        $branches = $this->branch->all();
        return view('branches.list', compact('branches'));
    }


    public function view($branchId)
    {
        $branchData = $this->branch->find($branchId);
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
