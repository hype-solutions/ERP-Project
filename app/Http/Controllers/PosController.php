<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Customers\Customers;
use App\Models\Pos\Cart;
use App\Models\Pos\PosSessions;
use App\Models\Products\Products;
use App\Models\Products\ProductsCategories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }

    public function start(Request $request)
    {
        $checkMobile = Customers::where('customer_mobile',$request->customer_mobile)->first();
            if($checkMobile){
                return back()->with('error','phone not unique');
            }else{


        $customerId = 0;
        $user = Auth::user();
        $user_id = $user->id;
        $type = $request->type;
        if($type == 1){
            $customer = new Customers();
            $customer->customer_name = $request->customer_name;
            $customer->customer_mobile = $request->customer_mobile;
            $customer->save();
            $customerId = $customer->id;
        }else if($type == 2){
            $customerId = $request->customer_id;
        }

        $session = new PosSessions();
        $session->branch_id = $request->branch;
        $session->customer_id = $customerId;
        $session->open_by = $user_id;
        // $session->sold_by = $user_id;
        $session->save();
        $newSessionId = $session->id;
        return redirect()->route('pos.index', $newSessionId);
    }
    }

    public function landing()
    {
        $sessions = PosSessions::where('status', 0)->get();
        $customers = Customers::all();
        $branches = Branches::all();
        return view('pos.landing', compact('sessions', 'customers','branches'));
    }

    public function receipt($sessionId){
        $currentCart = Cart::where('pos_session_id', $sessionId)->get();
        $currentSession = PosSessions::find($sessionId);
        return view('pos.receipt', compact('currentCart', 'sessionId','currentSession'));
    }
    public function index($sessionId)
    {
        $products = Products::all();
        $user = Auth::user();
        $user_id = $user->id;
        $productsCategories = ProductsCategories::all();
        $currentCart = Cart::where('pos_session_id', $sessionId)->get();
        $currentSession = PosSessions::find($sessionId);
        if($currentSession->customer_id > 0){
            $customerVisits = PosSessions::where('customer_id',$currentSession->customer_id)->count();
        }else{
            $customerVisits = 0;
        }
        return view('pos.pos', compact('user_id','products', 'productsCategories', 'currentCart', 'sessionId','currentSession','customerVisits'));
    }

    public function search(Request $request)
    {
        $products = Products::where('product_name', 'LIKE', '%' . $request->search . '%')->get();
        return response()->json(array('data' => $products), 200);
    }

    public function barcode(Request $request)
    {
        $products = Products::where('product_code', $request->barcode)->get();
        return response()->json(array('datax' => $products), 200);
    }

    public function finish(Request $request)
    {
        $pos_session_id = $request->session;
        $items = $request->item;
        $totalCost = 0;
        if($items){
        Cart::where('pos_session_id', $pos_session_id)->delete();
        $listOfItems = [];
        foreach ($items as $item) {
            $pro = new Cart();
            $pro->pos_session_id = $pos_session_id;
            $pro->product_id = $item['id'];
            $pro->product_name = $item['name'];
            $pro->product_qty = $item['qty'];
            $pro->product_price = $item['price'];
            $pro->save();
            $listOfItems[] = $pro;

            $product = Products::find($item['id']);
            $avg = $product->purchasesOrders();
            $totalCost += $avg * $item['qty'];
        }

    }


    $upd = PosSessions::find($pos_session_id);
    $upd->discount_amount = $request->discount_amount;
    $upd->discount_percentage = $request->discount_percentage;
    $upd->total = $request->total;
    $upd->cost = $totalCost;
    $upd->sold_by = $request->sold_by;
    $upd->sold_when = Carbon::now();
    if($request->end_or_save == 1){
        $upd->status = 1;
    }

    $upd->save();



    if($request->end_or_save == 1){
        return redirect()->route('pos.landing')->with('popup', 'open')->with('session', $pos_session_id);
    }else{
        return redirect()->route('pos.landing');
    }


        return redirect()->route('pos.landing')->with('popup', 'open')->with('session', $pos_session_id);
        // //get product id & session id
        // $product_id = $request->product;
        // $pos_session_id = $request->sess;
        // //check if it was sent successfully
        // if ($product_id) {
        //     //get product details
        //     $product = Products::find($product_id);
        //     //check if product has qty
        //     if ($product->product_total_in - $product->product_total_out > 0) {
        //         //check if user already has this product in cart
        //         $checkCart = Cart::where('pos_session_id', $pos_session_id)
        //             ->where('product_id', $product_id)
        //             ->first();
        //         if ($checkCart) {
        //             $item = Cart::where('pos_session_id', $pos_session_id)
        //                 ->where('product_id', $product_id)
        //                 ->increment('product_qty', 1);
        //         } else {
        //             $item = new Cart();
        //             $item->pos_session_id = $pos_session_id;
        //             $item->product_id = $product_id;
        //             $item->product_name = $product->product_name;
        //             $item->product_qty = 1;
        //             $item->product_price = $product->product_price;
        //             $item->included_by = 1;
        //             $item->added_at = 1;
        //             $item->save();
        //         }

        //         //$whatHappened = 1;
        //     } else {
        //         $item = 0;
        //     }
        // } else {
        //     $item = 0;
        // }

        // // return response()->json(array('data' => $item), 200);
        // return 1;
    }

    public function quickadd(Request $request)
    {
        $checkMobile = Customers::where('customer_mobile',$request->customer_mobile)->first();
        if($checkMobile){
            return response()->json(array('data' => 0), 200);
        }else{
        $customer = new Customers();
        $customer->customer_name = $request->customer_name;
        $customer->customer_mobile = $request->customer_mobile;
        $customer->save();

        $update = PosSessions::find($request->session);
        $update->customer_id = $customer->id;
        $update->save();

        return response()->json(array('data' => $customer->id), 200);
        }
    }

    // public function increment(Request $request)
    // {
    //     $product_id = $request->product;
    //     $pos_session_id = $request->sess;

    //     Cart::where('pos_session_id', $pos_session_id)
    //         ->where('product_id', $product_id)
    //         ->increment('product_qty', 1);
    //     return 1;
    // }

    // public function decrement(Request $request)
    // {
    //     $product_id = $request->product;
    //     $pos_session_id = $request->sess;
    //     $currentQty = Cart::where('pos_session_id', $pos_session_id)
    //         ->where('product_id', $product_id)
    //         ->first();
    //     if ($currentQty->product_qty == 1) {
    //         Cart::where('pos_session_id', $pos_session_id)
    //             ->where('product_id', $product_id)
    //             ->delete();
    //     } else {
    //         Cart::where('pos_session_id', $pos_session_id)
    //             ->where('product_id', $product_id)
    //             ->decrement('product_qty', 1);
    //     }
    //     return 1;
    // }

    // public function removeFromCart(Request $request)
    // {
    //     $product_id = $request->product;
    //     $pos_session_id = $request->sess;

    //     Cart::where('pos_session_id', $pos_session_id)
    //         ->where('product_id', $product_id)
    //         ->delete();

    //     return 1;
    // }
}
