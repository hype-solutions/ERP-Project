<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Branches\Branches;
use Illuminate\Http\Request;
use App\Http\Requests\Product\UpdateProduct;
use App\Http\Requests\Product\CreateProduct;
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
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    public function add()
    {
        $categories = ProductsCategories::all();
        $branches = Branches::all();
        return view('products.add', compact('categories', 'branches'));
    }

    public function store(CreateProduct $request)
    {
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
        $productPosSales = PosSessions::where('status', '!=', 0)->whereHas('cart', function ($q) use ($product) {
            $q->where('product_id', $product->id);
        })->with('cart')->get();

        $allowedBranches = BranchesProductsSelling::where('product_id', $product->id)->where('selling', 1)->with('branch')->get();
        $branches = BranchesProducts::where('product_id', $product->id)
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

        $productManual = ProductsManualQuantities::where('product_id', $product->id)
            ->with('branch')
            ->get();

        $productSuppliers = PurchasesOrdersProducts::where('product_id', $product->id)
            ->where('status', 'Delivered')
            ->get();

        $productId = $product->id;
        $productPurchasesOrders = PurchasesOrdersProducts::where('product_id', $productId)->where('status', 'Delivered')->with('purchase')->groupBy('purchase_id')->get();
        $productInvoices = InvoicesProducts::where('product_id', $productId)->with('invoice')->GroupBy('invoice_id')->get();
        $productCost = PurchasesOrdersProducts::where('product_id', $productId)->where('status', 'Delivered')->avg('product_price');

        return view('products.profile', compact('productPosSales', 'allowedBranches', 'productCost', 'productInvoices', 'supplierProducts', 'product', 'branches', 'productransfers', 'productManual', 'productSuppliers', 'productPurchasesOrders'));
    }

    public function productsList()
    {
        $products = Products::all();
        $catTitle = '';

        return view('products.list', compact('products', 'catTitle'));
    }

    public function productsListByCat($cat)
    {
        $products = Products::where('product_category', $cat)->get();
        $catTitle = ProductsCategories::where('id', $cat)->value('cat_name');

        return view('products.list', compact('products', 'catTitle'));
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

    public function update(products $product, UpdateProduct $request)
    {
        $product->update($request->except('_token'));
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
        return redirect()->route('products.view', $product)->with('success', 'product updated');
    }

    public function delete(products $product)
    {
        Products::destroy($product->id);
        return redirect('/products')->with('success', 'product deleted');
    }


    public function transfer(Products $product)
    {
        $productId = $product->id;
        $productBranches = BranchesProducts::where('product_id', $productId)->with('branch')->get();
        $otherBranches = Branches::get();
        $user = Auth::user();
        $userId = $user->id;

        return view('products.transfer', compact('product', 'productBranches', 'otherBranches', 'userId'));
    }

    public function fetchQty(Request $request)
    {
        $productId = $request->product;
        $branchId = $request->branch;

        $productBranches = BranchesProducts::where('product_id', $productId)
            ->where('branch_id', $branchId)
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
        $productId = $request->product;
        $product = Products::where('id', $productId)
            ->first();
        $price = $product->product_price;

        return response()->json(array('price' => $price), 200);
    }

    public function fetchCost(Request $request)
    {
        $productId = $request->product;
        $product = Products::where('id', $productId)
            ->first();
        $cost = $product->purchasesOrders();
        return response()->json(array('cost' => $cost), 200);
    }


    public function fetchOtherBranches(Request $request)
    {
        $otherId = $request->other_id;

        return Branches::where('id', '!=', $otherId)->get();
    }

    public function transfering(Request $request)
    {
        ProductsTransfers::create($request->all());

        return redirect()->route('products.list');
    }



    public function rejectingTransfer(ProductsTransfers $transfer)
    {
        $transfer->status = 'Rejected';
        $transfer->save();

        return redirect()->route('products.list');
    }


    public function acceptingTransfer(ProductsTransfers $transfer)
    {

        //make sure source branch have enough qty
        if ($transfer->branchFrom->getProductAmountInBranch($transfer->product_id)->amount >= $transfer->transfer_qty) {
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
            } else { //else add a new record
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
        $branches = Branches::get();
        $user = Auth::user();
        $userId = $user->id;

        return view('products.addqty', compact('product', 'branches', 'userId'));
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
        $productOldIn = $getProduct[0]->product_total_in;
        $productNewQty = $productOldIn + $request->qty;
        Products::where('id', $request->product_id)
            ->update(['product_total_in' => $productNewQty]);
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

    public function import()
    {
        return view('products.import');
    }

    public function importing(Request $request)
    {
        Excel::import(new ProductsImport, request()->file('importer'));
        return redirect()->route('products.list');
    }
}
