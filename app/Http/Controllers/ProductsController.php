<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\BranchesProducts;
use App\Models\ProductsTransfers;
use App\Models\ProductsManualQuantities;
use App\Models\PurchasesOrders;
use App\Models\PurchasesOrdersProducts;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate(
            [
                'product_code' => 'unique:products',
                'procuct_category' => '',
                'product_sub_category' => '',
                'product_name' => 'required|max:255',
                'product_price' => 'required',
                'product_total_in' => '',
                'product_total_out' => '',
                'product_desc' => '',
                'product_brand' => '',
                'product_track_stock' => '',
                'product_low_stock_thershold' => '',
                'product_notes' => '',
            ],
            [
                'product_code.unique' => 'برجاء إختيار كود اخر, هذا الكود مستخدم بالفعل',
            ]
        );
    }
    protected function validateUpdateRequest()
    {
        return request()->validate([
            'product_code' => '',
            'procuct_category' => '',
            'product_sub_category' => '',
            'product_name' => 'required|max:255',
            'product_price' => 'required',
            'product_total_in' => '',
            'product_total_out' => '',
            'product_desc' => '',
            'product_brand' => '',
            'product_track_stock' => '',
            'product_low_stock_thershold' => '',
            'product_notes' => '',
        ]);
    }


    public function add()
    {
        return view('products.add');
    }

    public function store()
    {
        Products::create($this->validatePostRequest());
        return back()->with('success', 'product Added');
    }

    public function view(products $product)
    {
        // $productx = Products::find($product);
        // $product_id = $productx->id;
        $branches = BranchesProducts::where('product_id', $product->id)
            ->where('amount', '!=', 0)
            ->with('branch')->get();
        $productransfers = ProductsTransfers::where('transfer_qty', '>', 0)
            ->where('product_id', $product->id)
            ->with('branchFrom')
            ->with('branchTo')
            ->get();
        $productManual = ProductsManualQuantities::where('product_id', $product->id)
        ->with('branch')
        ->get();

        $productSuppliers = PurchasesOrdersProducts::where('product_id',$product->id)
        ->where('status','delivered')
        ->get();
        $product_id = $product->id;
        $productPurchasesOrders = PurchasesOrders::with(['productInOrder' => function($q) use ($product_id){
           $q->where('product_id', $product_id);
        }])->get();
        return view('products.profile', compact('product', 'branches', 'productransfers','productManual','productSuppliers','productPurchasesOrders'));
    }
    public function edit(products $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(products $product)
    {
        $product->update($this->validateUpdateRequest());
        return back()->with('success', 'product updated');
    }

    public function delete(products $product)
    {
        Products::destroy($product->id);
        return redirect('/products')->with('success', 'product deleted');
    }

    public function productsList()
    {
        $products = Products::all();
        return view('products.list', compact('products'));
    }
    public function transfer(Products $product)
    {
        //$product = Products::find($product);
        $product_id = $product->id;
        $productBranches = BranchesProducts::where('product_id', $product_id)->with('branch')->get();
        $otherBranches = Branches::get();
        $user = Auth::user();
        $user_id = $user->id;
        return view('products.transfer', compact('product', 'productBranches', 'otherBranches', 'user_id'));
    }
    public function fetchQty(Request $request)
    {
        $product_id = $request->product;
        $branch_id = $request->branch;

        $productBranches = BranchesProducts::where('product_id', $product_id)
            ->where('branch_id', $branch_id)
            ->first();
        $amount = $productBranches->amount;
        return response()->json(array('amount' => $amount), 200);
    }
    public function fetchOtherBranches(Request $request)
    {
        $other_id = $request->other_id;

        $otherBranches = Branches::where('id', '!=', $other_id)->get();
        return $otherBranches;
    }

    public function transfering(Request $request)
    {

        ProductsTransfers::create($request->all());

        BranchesProducts::where('product_id', $request->product_id)
            ->where('branch_id', $request->branch_from)
            ->update(['amount' => $request->qty_after_transfer_from]);

        $checkIfRecordExsists = BranchesProducts::where('branch_id', $request->branch_to)
            ->where('product_id', $request->product_id)
            ->first();
        //if product exsists on main branch, update its qty
        if (isset($checkIfRecordExsists)) {

            BranchesProducts::where('product_id', $request->product_id)
                ->where('branch_id', $request->branch_to)
                ->update(['amount' => $request->qty_after_transfer_to]);
        }
        //else add a new record
        else {
            $addToMain = new BranchesProducts;
            $addToMain->branch_id = $request->branch_to;
            $addToMain->product_id = $request->product_id;
            $addToMain->amount = $request->qty_after_transfer_to;
            $addToMain->save();
        }

        return redirect()->route('products.list');
    }

    public function addQty(Products $product)
    {
        //$product = Products::find($product);
        $product_id = $product->id;
        // $branches = Branches::where('product_id', $product_id)->with('branch')->get();
        $branches = Branches::get();
        $user = Auth::user();
        $user_id = $user->id;
        return view('products.addqty', compact('product', 'branches', 'user_id'));
    }
    public function addingQty(Request $request)
    {

        ProductsManualQuantities::create($request->all());

        $checkQtyInBranch = BranchesProducts::where('product_id', $request->product_id)
            ->where('branch_id', $request->branch_id)
            ->count();

        if ($checkQtyInBranch == 0) {

            $createRecord = new BranchesProducts;
            $createRecord->product_id = $request->product_id;
            $createRecord->branch_id = $request->branch_id;
            $createRecord->amount = $request->qty;
            $createRecord->save();
        } else {
            BranchesProducts::where('product_id', $request->product_id)
                ->where('branch_id', $request->branch_id)
                ->update(['amount' => $request->qty]);
        }

        $getProduct = Products::where('id', $request->product_id)->get();
        $product_old_in = $getProduct[0]->product_total_in;
        $product_new_qty = $product_old_in + $request->qty;
        Products::where('id', $request->product_id)
            ->update(['product_total_in' => $product_new_qty]);
        return redirect()->route('products.list');
    }
}
