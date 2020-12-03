<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\Products;
use App\Models\PurchasesOrders;
use App\Models\PurchasesOrdersPayments;
use App\Models\PurchasesOrdersProducts;
use App\Models\Safes;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasesOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }

    public function add()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $suppliers = Suppliers::all();
        $products = Products::all();
        $safes = Safes::all();
        return view('purchases_orders.add',compact('user_id','suppliers','products','safes'));
    }

public function purchasesordersList()
{
    $purchases = PurchasesOrders::all();
    return view('purchases_orders.list',compact('purchases'));


}

    public function store(Request $request){
        $purchase = new PurchasesOrders;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->purchase_note = $request->purchase_note;
        $purchase->discount_percentage = $request->discount_percentage;
        $purchase->discount_amount = $request->discount_amount;
        $purchase->payment_method = $request->payment_method;
        $purchase->purchase_date = Carbon::now();
        if($request->already_paid == 'on')
        {
            $alreadyPaid = 1;
            $purchase->safe_id = $request->safe_id_if_paid;
        }
        else{
            $alreadyPaid = 0;
            $purchase->safe_id = $request->safe_id_not_paid;
        }
        $purchase->already_paid = $alreadyPaid;
        $purchase->payment_method = $request->payment_method;
        $purchase->safe_payment_id = $request->safe_payment_id;
        $purchase->already_delivered = 0;
        $purchase->purchase_total = $request->purchase_total;
        $purchase->shipping_fees = $request->shipping_fees;
        $purchase->save();

        $purchaseId = $purchase->id;
        $product = $request->product;
        $date = $request->later;
        $supplierId = $purchase->supplier_id;

        //Save Items
        $listOfProducts = [];
        foreach ($product as $item) {
                $pro = new PurchasesOrdersProducts();
                $pro->purchase_id = $purchaseId;
                $pro->supplier_id = $supplierId;
                $pro->product_desc = $item['id'];
                $pro->product_desc = $item['desc'];
                $pro->product_price = $item['price'];
                $pro->product_qty = $item['qty'];
                $pro->save();
                $listOfProducts[] = $pro;
        }

        if($request->payment_method == 'later'){
            $listOfDates = [];
        foreach ($date as $item) {
                $da = new PurchasesOrdersPayments();
                $da->purchase_id = $purchaseId;
                $da->supplier_id = $supplierId;
                $da->amount = $item['amount'];
                $da->date = $item['date'];
                $da->notes = $item['notes'];
                 $da->save();
                $listOfDates[] = $da;
        }
        }
        return redirect('/purchase_orders')->with('success', 'purchase added');

     }

}
