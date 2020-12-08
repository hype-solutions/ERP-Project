<?php

namespace App\Http\Controllers;

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
        //Get current user id
        $user = Auth::user();
        $user_id = $user->id;

        //Get main branch details
        $mainBranch = Branches::first();
        $mainBranchId = $mainBranch->id;

        //Get products ids that are saved on deleted branch
        $oldBranchProducts = BranchesProducts::where('branch_id',$branch->id)->get();
        foreach($oldBranchProducts as $product){
            $foundProductId = $product->product_id;
            $foundProductAmount = $product->amount;
            //Check if this product exsists on main branch
            $checkMainBranch = BranchesProducts::where('branch_id',$mainBranchId)
                                               ->where('product_id',$foundProductId)
                                               ->first();
            //if product exsists on main branch, update its qty
            if(isset($checkMainBranch)){
            $currentQty = $checkMainBranch->amount;
            $newQty = $currentQty + $foundProductAmount;
            BranchesProducts::where('product_id',$foundProductId)
                            ->where('branch_id',$mainBranchId)
                            ->update(['amount' => $newQty]);
            }
            //else add a new record
            else{
            $newQty = $foundProductAmount;
            $addToMain = new BranchesProducts;
            $addToMain->branch_id = $mainBranchId;
            $addToMain->product_id = $foundProductId;
            $addToMain->amount = $newQty;
            $addToMain->save();
            }

        //Delete deleted Branch Product Records
        BranchesProducts::where('branch_id',$branch->id)->delete();

        //Create a products transfer record
        $transfer = new ProductsTransfers;
        $transfer->product_id = $foundProductId;
        $transfer->branch_from = $branch->id;
        $transfer->transfer_qty = $foundProductAmount;
        $transfer->qty_before_transfer_from = $foundProductAmount;
        $transfer->qty_after_transfer_from = 0;
        $transfer->branch_to = $mainBranchId;
        $transfer->qty_before_transfer_to = $currentQty;
        $transfer->qty_after_transfer_to = $newQty;
        $transfer->transfer_datetime = Carbon::now();
        $transfer->transfer_notes = 'عملية تحويل كميات من فرع الى أخر بسبب حذف فرع, اسم الفرع قبل الحذف '.$branch->branch_name;
        $transfer->transfered_by = $user_id;
        $transfer->authorized_by = 0;
        $transfer->save();
        }

        //Get branch connected safe details
        $getSafe = Safes::where('branch_id',$branch->id)->first();
        $safeBalance = $getSafe->safe_balance;
        $safeName = $getSafe->safe_name;
        $safeId = $getSafe->id;

        //Get main branch connected safe details
        $getMainSafe = Safes::where('branch_id',$mainBranchId)->first();
        $mainSafeId = $getMainSafe->id;
        $mainSafeBalance = $getMainSafe->safe_balance;

        //Transfer amount from deleted safe to main safe balance
        $totalNew = $mainSafeBalance + $safeBalance;
        $getMainSafe->safe_balance = $totalNew;
        $getMainSafe->save();

        //Create a money transfer record
        $transfer = new SafesTransfers();
        $transfer->safe_from = $safeId;
        $transfer->transfer_amount = $safeBalance;
        $transfer->amount_before_transfer_from = $safeBalance;
        $transfer->amount_after_transfer_from = 0;
        $transfer->safe_to = $mainSafeId;
        $transfer->amount_before_transfer_to = $mainSafeBalance;
        $transfer->amount_after_transfer_to = $totalNew;
        $transfer->transfer_datetime = Carbon::now();
        $transfer->transfer_notes = 'عملية تحويل رصيد خزنة بسبب حذفها - اسم الخزنة قبل الحذف '.$safeName;
        $transfer->transfered_by = $user_id;
        $transfer->authorized_by = 0;
        $transfer->save();

        //Delete branch
        Branches::destroy($branch->id);

        //Delete connected safe
        Safes::where('branch_id',$branch->id)->delete();

        return redirect('/branches')->with('success', 'Branch Deleted');
    }

    public function branchesList()
    {
        $branches = Branches::all();
        return view('branches.list',compact('branches'));
    }
}
