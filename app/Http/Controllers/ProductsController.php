<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use Illuminate\Http\Request;

use App\Models\Products\Products;
use App\Models\Branches\BranchesProducts;
use App\Models\Branches\BranchesProductsSelling;
use App\Models\Invoices\InvoicesProducts;
use App\Models\Pos\PosSessions;
use App\Models\Products\ProductsCategories;
use App\Models\Products\ProductsTransfers;
use App\Models\Products\ProductsManualQuantities;
use App\Models\PurchasesOrders\PurchasesOrdersProducts;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate(
            [
                'product_code' => '',
                'product_category' => '',
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
                // 'product_code.unique' => 'برجاء إختيار كود اخر, هذا الكود مستخدم بالفعل',
            ]
        );
    }
    protected function validateUpdateRequest()
    {
        return request()->validate([
            'product_code' => '',
            'product_category' => '',
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
        $categories = ProductsCategories::all();
        $branches = Branches::all();
        return view('products.add', compact('categories', 'branches'));
    }

    public function store(Request $request)
    {
        //Products::create($this->validatePostRequest());
        $product = new Products();
        $product->product_code = $request->product_code;
        $product->product_category = $request->product_category;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_desc = $request->product_desc;
        $product->product_brand = $request->product_brand;
        if (!$request->product_track_stock) {
            $product->product_track_stock = 0;
        } else {
            $product->product_track_stock = $request->product_track_stock;
        }
        $product->product_low_stock_thershold = $request->product_low_stock_thershold;
        $product->product_notes = $request->product_notes;
        $product->save();
        $productId = $product->id;

        $branchx = $request->branch;
        foreach ($branchx as $item) {
            $pro = new BranchesProductsSelling();
            $pro->branch_id = $item['id'];
            $pro->product_id = $productId;
            if (isset($item['selling'])) {
                $pro->selling = 1;
            }
            $pro->save();
        }

        return back()->with('success', 'product Added');
    }

    public function view(products $product)
    {

        // $productPosSales = PosSessions::where('product_id', $product->id)->get();
        $productPosSales = PosSessions::where('status',1)->whereHas('cart', function($q) use($product){
            $q->where('product_id', $product->id);
         })->with('cart')->get();



        //  dd($productPosSales);
        $allowedBranches = BranchesProductsSelling::where('product_id', $product->id)->where('selling', 1)->with('branch')->get();
        $branches = BranchesProducts::where('product_id', $product->id)
            // ->where('amount', '!=', 0)
            ->with('branch')->get();
        $supplierProducts = PurchasesOrdersProducts::groupBy('supplier_id')
            ->where('status', 'Delivered')
            ->where('product_id', $product->id)
            ->selectRaw('purchases_orders_products.*, sum(product_qty) as quantity, min(product_price) as minprice, max(product_price) as maxprice, count(id) as counttimes, supplier_id')
            ->get();
        $productransfers = ProductsTransfers::where('transfer_qty', '>', 0)
            ->where('product_id', $product->id)
            ->with('branchFrom')
            ->with('branchTo')
            ->get();

            // dd($productransfers);
        $productManual = ProductsManualQuantities::where('product_id', $product->id)
            ->with('branch')
            ->get();

        $productSuppliers = PurchasesOrdersProducts::where('product_id', $product->id)
            ->where('status', 'Delivered')
            ->get();


        $product_id = $product->id;

        $productPurchasesOrders = PurchasesOrdersProducts::where('product_id', $product_id)->where('status', 'Delivered')->with('purchase')->groupBy('purchase_id')->get();

        $productInvoices = InvoicesProducts::where('product_id', $product_id)->with('invoice')->GroupBy('invoice_id')->get();


        $productCost = PurchasesOrdersProducts::where('product_id', $product_id)->where('status', 'Delivered')->avg('product_price');


        return view('products.profile', compact('productPosSales','allowedBranches', 'productCost', 'productInvoices', 'supplierProducts', 'product', 'branches', 'productransfers', 'productManual', 'productSuppliers', 'productPurchasesOrders'));
    }

    // public function test(){
    //     $product = Products::find(1);
    //     $product->avg = $product->purchasesOrders();

    //     return $product->avg;
    // }

    public function productsList()
    {
        $products = Products::all();
        $catTitle = '';

        return view('products.list', compact('products','catTitle'));
    }

    public function productsListByCat($cat)
    {
        $products = Products::where('product_category',$cat)->get();
        $catTitle = ProductsCategories::where('id',$cat)->value('cat_name');

        return view('products.list', compact('products','catTitle'));
    }

    public function edit(products $product)
    {
        $branches = BranchesProductsSelling::where('product_id', $product->id)->with('branch')->get();
        if ($product->product_category > 0) {
            $otherCategories = ProductsCategories::where('id', '!=', $product->product_category)->get();
        } else {
            $otherCategories = ProductsCategories::all();
        }

        return view('products.edit', compact('branches', 'product', 'otherCategories'));
    }

    public function update(products $product, Request $request)
    {
        $product->update($this->validateUpdateRequest());
        $branchx = $request->branch;
        foreach ($branchx as $item) {
            $pro = BranchesProductsSelling::where('branch_id', $item['id'])->where('product_id', $product->id)->first();
            if (isset($item['selling'])) {
                $pro->selling = 1;
            } else {
                $pro->selling = 0;
            }
            $pro->save();
        }
        return back()->with('success', 'product updated');
    }

    public function delete(products $product)
    {
        Products::destroy($product->id);
        return redirect('/products')->with('success', 'product deleted');
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
        if ($productBranches) {
            $amount = $productBranches->amount;
        } else {
            $amount = 0;
        }
        return response()->json(array('amount' => $amount), 200);
    }
    public function fetchPrice(Request $request)
    {
        $product_id = $request->product;
        $product = Products::where('id', $product_id)
            ->first();
        $price = $product->product_price;
        return response()->json(array('price' => $price), 200);
    }

    public function fetchCost(Request $request)
    {
        $product_id = $request->product;
        $product = Products::where('id', $product_id)
            ->first();
        $cost = $product->purchasesOrders();
        return response()->json(array('cost' => $cost), 200);
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



        return redirect()->route('products.list');
    }



    public function rejectingTransfer(ProductsTransfers $transfer){

        $transfer->status = 'Rejected';
        //$transfer->authorized_by = Auth::id();
        $transfer->save();
        return redirect()->route('products.list');
    }


    public function acceptingTransfer(ProductsTransfers $transfer)
    {

        //make sure source branch have enough qty
        if($transfer->branchFrom->getProductAmountInBranch($transfer->product_id)->amount >= $transfer->transfer_qty){


        BranchesProducts::where('product_id', $transfer->product_id)
            ->where('branch_id', $transfer->branch_from)
            ->update(['amount' => $transfer->qty_after_transfer_from]);

        $checkIfRecordExsists = BranchesProducts::where('branch_id', $transfer->branch_to)
            ->where('product_id', $transfer->product_id)
            ->first();
        //if product exsists on main branch, update its qty
        if (isset($checkIfRecordExsists)) {

            BranchesProducts::where('product_id', $transfer->product_id)
                ->where('branch_id', $transfer->branch_to)
                ->update(['amount' => $transfer->qty_after_transfer_to]);
        }
        //else add a new record
        else {
            $addToMain = new BranchesProducts;
            $addToMain->branch_id = $transfer->branch_to;
            $addToMain->product_id = $transfer->product_id;
            $addToMain->amount = $transfer->qty_after_transfer_to;
            $addToMain->save();
        }

        $transfer->status = 'Transfered';
        $transfer->authorized_by = Auth::id();
        $transfer->save();
    }
        return redirect()->route('products.list');
    }


    public function barcode($code, $qty)
    {
        return view('products.barcode', compact('code', 'qty'));
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
        return redirect()->route('products.transfers');
    }



    public function productSelect()
    {
        $products = Products::all();
        return view('products.select', compact('products'));
    }

    public function selecting(Request $request)
    {
        if ($request->userChoise == '1') {
            return redirect()->route('products.transfer', $request->product_id);
        } else {
            return redirect()->route('products.addQty', $request->product_id);
        }
    }


    public function transfers()
    {

        $transfers = ProductsTransfers::all();

        return view('products.transfersList', compact('transfers'));
    }

}
