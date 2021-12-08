<?php

namespace App\Models\Products;

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable =
    [
        'product_code',
        'product_category',
        'product_sub_category',
        'product_name',
        'product_price',
        'product_total_in',
        'product_total_out',
        'product_desc',
        'product_brand',
        'product_track_stock',
        'product_low_stock_thershold',
        'product_notes',
    ];

    public function cat()
    {
        return $this->hasOne('App\Models\Products\ProductsCategories', 'id', 'product_category');
    }

    public function purchasesOrders()
    {
        return $this->belongsTo('App\Models\PurchasesOrders\PurchasesOrdersProducts', 'id', 'product_id')->where('status', 'Delivered')->avg('product_price');
    }

    public function amountInBranch($branchId)
    {
        $branch = Branches::find($branchId);
        if ($branch) {
            $product = BranchesProducts::where('product_id', $this->id)->where('branch_id', $branch->branchId)->count();
            if ($product > 0) {
                return BranchesProducts::where('product_id', $this->id)->where('branch_id', $branch->branchId)->value('amount');
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
