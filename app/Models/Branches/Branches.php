<?php

namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branches\BranchesProducts;
use App\Models\Products\ProductsTransfers;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransfers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Branches extends Model
{
    use HasFactory;
    protected $table = 'branches';
    protected $fillable = [
        'branch_name',
        'branch_phone',
        'branch_mobile',
        'branch_address',
        'branch_email',
    ];

    //General
    public function getMainBranchId()
    {
        return Branches::first()->value('id');
    }

    public function deleteBranch()
    {
        return Branches::destroy($this->id);
    }

    //Branch Products
    public function branchProductsinStock()
    {
        return $this->hasMany(BranchesProducts::class, 'branch_id', 'id')
            ->where('amount', '!=', 0)
            ->with('product')
            ->get();
    }

    public function branchProductsinStockCount()
    {
        return $this->hasMany(BranchesProducts::class, 'branch_id', 'id')
            ->where('amount', '!=', 0)
            ->count();
    }


    public function deleteBranchProductsRecords()
    {
        return BranchesProducts::where('branch_id', $this->id)->delete();
    }

    public function deleteBranchAllowedProductsList()
    {
        return BranchesProductsSelling::where('branch_id', $this->id)->delete();
    }

    public function getProductAmountInBranch($id)
    {
        return BranchesProducts::where('product_id', $id)->first();
    }


    public function checkIfThisProductInMainBranch($id)
    {
        return BranchesProducts::where('branch_id', $this->getMainBranchId())->where('product_id', $id)->count();
    }

    public function insertProdutcInMainBranch($id, $amount)
    {
        return BranchesProducts::insert([
            'branch_id' => $this->getMainBranchId(),
            'product_id' => $id,
            'amount' => $amount
        ]);
    }

    public function updateMainBranchbeforeDeletingOther($id)
    {
        $currentAmountInToDeleteBranch =  $this->branchProductsinStock()->where('branch_id', $this->id)->where('product_id', $id)->first()->value('amount');
        BranchesProducts::where('branch_id', $this->getMainBranchId())->where('product_id', $id)->increment('amount', $currentAmountInToDeleteBranch);
    }

    //Safes
    public function getBranchSafeDetails()
    {
        return $this->hasOne(Safes::class, 'branch_id', 'id')->first();
    }

    public function transferBalance($amount)
    {
        Safes::where('branch_id',$this->getMainBranchId())->increment('safe_balance',$amount);

    }


    public function deleteSafe($id)
    {
        return Safes::destroy($this->getBranchSafeDetails()->where('branch_id',$id)->value('id'));
    }


    public function CreateMoneyTransferRecord($id,$amount){
        $transfer = new SafesTransfers();
        $transfer->safe_from = $id;
        $transfer->transfer_amount = $amount;
        $transfer->amount_before_transfer_from = $amount;
        $transfer->amount_after_transfer_from = 0;
        $transfer->safe_to = $this->getBranchSafeDetails()->where('branch_id',$this->getMainBranchId())->value('id');
        $transfer->amount_before_transfer_to = $this->getBranchSafeDetails()->where('branch_id',$this->getMainBranchId())->value('safe_balance');
        $transfer->amount_after_transfer_to = $amount + $this->getBranchSafeDetails()->where('branch_id',$this->getMainBranchId())->value('safe_balance');
        $transfer->transfer_datetime = Carbon::now();
        $transfer->transfer_notes = 'عملية تحويل رصيد خزنة بسبب حذفها - اسم الخزنة قبل الحذف ' . $this->getBranchSafeDetails()->where('branch_id',$id)->value('safe_name');
        $transfer->transfered_by = Auth::id();
        $transfer->authorized_by = Auth::id();
        $transfer->save();
    }

    //Products Transfer
    public function CreateProductTransferRecord($id, $amount)
    {
        $transfer = new ProductsTransfers();
        $transfer->product_id = $id;
        $transfer->branch_from = $this->id;
        $transfer->transfer_qty = $amount;
        $transfer->qty_before_transfer_from = $amount;
        $transfer->qty_after_transfer_from = 0;
        $transfer->branch_to = $this->getMainBranchId();
        $transfer->qty_before_transfer_to = $this->getProductAmountInBranch($id)->where('branch_id', $this->getMainBranchId())->value('amount');
        $transfer->qty_after_transfer_to = $amount + $this->getProductAmountInBranch($id)->where('branch_id', $this->getMainBranchId())->value('amount');
        $transfer->transfer_datetime = Carbon::now();
        $transfer->status = 'Transfered';
        $transfer->transfer_notes = 'عملية تحويل كميات من فرع الى أخر بسبب حذف فرع, اسم الفرع قبل الحذف ' . $this->branch_name;
        $transfer->transfered_by = Auth::id();
        $transfer->authorized_by = Auth::id();
        $transfer->save();
    }
}
