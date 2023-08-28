<?php

namespace App\Http\Controllers;

use App\Models\Branches\Branches;
use App\Models\Branches\BranchesProducts;
use App\Models\Branches\BranchesProductsSelling;
use App\Models\Customers\Customers;
use App\Models\Pos\Cart;
use App\Models\Pos\PosSessions;
use App\Models\Products\Products;
use App\Models\Products\ProductsCategories;
use App\Models\Safes\Safes;
use App\Models\Safes\SafesTransactions;
use App\Models\Settings\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
        $this->middleware('auth');
    }

    public function start(Request $request)
    {
        $checkMobile = Customers::where('customer_mobile', $request->customer_mobile)->first();
        if ($checkMobile) {
            return back()->with('error', 'phone not unique');
        } else {
            $customerId = 0;
            $user = Auth::user();
            $userId = $user->id;
            $type = $request->type;
            if ($type == 1) {
                $customer = new Customers();
                $customer->customer_name = $request->customer_name;
                $customer->customer_type = 'solo';
                $customer->customer_mobile = $request->customer_mobile;
                $customer->save();
                $customerId = $customer->id;
            } elseif ($type == 2) {
                $customerId = $request->customer_id;
            }

            $session = new PosSessions();
            $session->branch_id = $request->branch;
            $session->customer_id = $customerId;
            $session->open_by = $userId;
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
        Carbon::setlocale("ar");

        return view('pos.landing', compact('sessions', 'customers', 'branches'));
    }

    public function receipt($sessionId)
    {
        $currentCart = Cart::where('pos_session_id', $sessionId)->get();
        $currentSession = PosSessions::find($sessionId);
        $logo = Settings::where('key', 'logo')->value('value');
        $company = Settings::where('key', 'company_name')->value('value');
        return view('pos.receipt', compact('company', 'logo', 'currentCart', 'sessionId', 'currentSession'));
    }

    public function index($sessionId)
    {
        $currentSession = PosSessions::with('customer')->find($sessionId);
        if (empty($currentSession)) {
            abort(404);
        }
        if ($currentSession->status == 1) {
            abort(404);
        }

        $currentBranch = $currentSession->branch_id;
        $allowedProducts = [];
        $getBranchProducts = BranchesProductsSelling::where('branch_id', $currentBranch)->get();
        foreach ($getBranchProducts as $product) {
            if ($product->selling > 0) {
                array_push($allowedProducts, $product->product_id);
            }
        }
        $products = Products::whereIn('id', $allowedProducts)->paginate(8);
        $allProducts = Products::whereIn('id', $allowedProducts)->get();
        $user = Auth::user();
        $userId = $user->id;
        $productsCategories = ProductsCategories::all();
        $currentCart = Cart::where('pos_session_id', $sessionId)->get();

        if ($currentSession->customer_id > 0) {
            $customerVisits = PosSessions::where('customer_id', $currentSession->customer_id)->count();
            $mostOrdered = $currentSession->mostOrdered();
            $lastVisitDate = $currentSession->lastVisitDate();
        } else {
            $customerVisits = 0;
            $mostOrdered = '';
            $lastVisitDate = '';
        }
        $logo = Settings::where('key', 'logo')->value('value');

        return view('pos.pos', compact('allProducts', 'logo', 'userId', 'products', 'productsCategories', 'currentCart', 'sessionId', 'currentSession', 'customerVisits', 'mostOrdered', 'lastVisitDate'));
    }

    public function search(Request $request)
    {
        $sessionId = $request->session;
        $currentSession = PosSessions::find($sessionId);
        $currentBranch = $currentSession->branch_id;
        $allowedProducts = [];
        $getBranchProducts = BranchesProductsSelling::where('branch_id', $currentBranch)->get();
        foreach ($getBranchProducts as $product) {
            if ($product->selling > 0) {
                array_push($allowedProducts, $product->product_id);
            }
        }
        $products = Products::whereIn('id', $allowedProducts)->where('product_name', 'LIKE', '%' . $request->search . '%')->get();
        foreach ($products as $key => $product) {
            $products[$key]->availability = $product->amountInBranch($currentBranch);
        }
        return response()->json(array('data' => $products), 200);
    }

    public function barcode(Request $request)
    {
        $sessionId = $request->session;
        $currentSession = PosSessions::find($sessionId);
        $currentBranch = $currentSession->branch_id;
        $allowedProducts = [];
        $getBranchProducts = BranchesProductsSelling::where('branch_id', $currentBranch)->get();
        foreach ($getBranchProducts as $product) {
            if ($product->selling > 0) {
                array_push($allowedProducts, $product->product_id);
            }
        }
        $products = Products::whereIn('id', $allowedProducts)->where('product_code', $request->barcode)->get();
        return response()->json(array('datax' => $products), 200);
    }

    public function finish(Request $request)
    {
        $posSessionId = $request->session;
        $items = $request->item;
        $totalCost = 0;
        if ($items) {
            Cart::where('pos_session_id', $posSessionId)->delete();
            $listOfItems = [];
            //Save Items
            foreach ($items as $item) {
                Products::where('id', $item['id'])->increment('product_total_out', $item['qty']);
                BranchesProducts::where('product_id', $item['id'])
                    ->where('branch_id', $request->branch_id)
                    ->decrement('amount', $item['qty']);
            }

            foreach ($items as $item) {
                $pro = new Cart();
                $pro->pos_session_id = $posSessionId;
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


        $upd = PosSessions::find($posSessionId);
        $upd->discount_amount = $request->discount_amount;
        $upd->discount_percentage = $request->discount_percentage;
        $upd->total = $request->total;
        $upd->cost = $totalCost;
        $upd->sold_by = $request->sold_by;
        $upd->sold_when = Carbon::now();
        if ($request->end_or_save == 1) {
            $upd->status = 1;
        }

        $upd->save();


        if ($request->end_or_save == 1) {
            $safeId = Safes::where('branch_id', $request->branch_id)->value('id');
            $payment = new SafesTransactions();
            $payment->safe_id = $safeId;
            $payment->transaction_type = 2;
            $payment->transaction_amount = $request->total;
            $payment->transaction_datetime = Carbon::now();
            $payment->done_by = $request->sold_by;
            $payment->transaction_notes = 'عملية بيع سريع رقم  ' . $posSessionId;
            $payment->authorized_by = $request->sold_by;
            $payment->save();

            Safes::where('id', $safeId)->increment('safe_balance', $request->total);
        }
        if ($request->end_or_save == 1) {
            return redirect()->route('pos.landing')->with('popup', 'open')->with('session', $posSessionId);
        } else {
            return redirect()->route('pos.landing');
        }
    }

    public function quickadd(Request $request)
    {
        $checkMobile = Customers::where('customer_mobile', $request->customer_mobile)->first();
        if ($checkMobile) {
            return response()->json(array('data' => 0), 200);
        } else {
            $customer = new Customers();
            $customer->customer_name = $request->customer_name;
            $customer->customer_type = 'solo';
            $customer->customer_mobile = $request->customer_mobile;
            $customer->save();

            $update = PosSessions::find($request->session);
            $update->customer_id = $customer->id;
            $update->save();

            return response()->json(array('data' => $customer->id), 200);
        }
    }


    public function cancel($sessionId)
    {
        $posSession = PosSessions::find($sessionId);
        $items = Cart::where('pos_session_id', $sessionId)->get();
        foreach ($items as $item) {
            Products::where('id', $item->product_id)->decrement('product_total_out', $item->product_qty);
            BranchesProducts::where('product_id', $item->product_id)
                ->where('branch_id', $posSession->branch_id)
                ->increment('amount', $item->product_qty);
        }
        PosSessions::find($sessionId)->delete();
        Cart::where('pos_session_id', $sessionId)->delete();

        return redirect()->route('pos.landing');
    }

    public function refunds()
    {
        Carbon::setlocale("ar");
        $sessions = $this->refundable();

        return view('pos.refunds', compact('sessions'));
    }

    public function refundsSearch(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $sessions = PosSessions::where("id", "LIKE", "%{$request->search}%")
                // ->where('status', 1)
                ->whereIn('id', $this->refundable())
                ->get();
            if ($sessions) {
                foreach ($sessions as $session) {
                    $output .= '<tr>' .
                        '<td><h3><b>' . $session->id . '</b></h3></td>' .
                        '<td>' . $session->sell_user->username . '</td>' .
                        '<td>' . $session->branch->branch_name . '</td>';
                    if ($session->customer) {
                        $output .=
                            '<td>' . $session->customer->customer_name . '</td>';
                    } else {
                        $output .=
                            '<td><span class="info">زائر</span></td>';
                    }
                    $output .=
                        '<td>' . $session->sold_when . '</td>' .
                        '<td>' . $session->total . '</td>' .
                        '<td><a href="/pos/refunds/' . $session->id . '" class="btn btn-success btn-sm">إختر</a></td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function refundView($session)
    {
        $currentSession = PosSessions::with('customer')->find($session);
        $currentCart = Cart::where('pos_session_id', $session)->where('status', '!=', 2)->get();
        $cart = new Cart();
        $subtotal = $cart->subTotal($session);

        return view('pos.refundView', compact('session', 'currentCart', 'currentSession', 'subtotal'));
    }

    public function refundSome(Request $request)
    {
        $totalCost = 0;
        $user = Auth::user();
        $userId = $user->id;
        $posSession = PosSessions::find($request->sessionId);
        $posSession->status = 2; //refunded
        $posSession->total = $request->total; //refunded
        $posSession->refunded_by = $userId;
        $posSession->refunded_when = Carbon::now();

        $updatedItems = $request->item;
        if ($updatedItems) {
            $items = Cart::where('pos_session_id', $request->sessionId)->get();
            foreach ($items as $item) {
                $currentItemId = $item->product_id;
                foreach ($updatedItems as $updatedItem) {
                    if ($currentItemId == $updatedItem['id']) {
                        if ($updatedItem['qty'] == 0) {
                            Products::where('id', $item->product_id)->decrement('product_total_out', $item->product_qty);
                            BranchesProducts::where('product_id', $item->product_id)
                                ->where('branch_id', $posSession->branch_id)
                                ->increment('amount', $item->product_qty);
                            Cart::where('pos_session_id', $request->sessionId)->where('product_id', $item->product_id)
                                ->update([
                                    'status' => 2
                                ]);
                        } elseif ($item->product_qty - $updatedItem['qty'] == 0) {
                            //nothing returned
                        } else {
                            Products::where('id', $item->product_id)->decrement('product_total_out', $item->product_qty - $updatedItem['qty']);
                            BranchesProducts::where('product_id', $item->product_id)
                                ->where('branch_id', $posSession->branch_id)
                                ->increment('amount', $item->product_qty - $updatedItem['qty']);
                            Cart::where('pos_session_id', $request->sessionId)->where('product_id', $item->product_id)->where('status', '!=', 2)
                                ->update([
                                    'product_qty' => $updatedItem['qty']
                                ]);
                            $pro = new Cart();
                            $pro->pos_session_id = $request->sessionId;
                            $pro->product_id = $updatedItem['id'];
                            $pro->product_name = $updatedItem['name'];
                            $pro->product_qty = $item->product_qty - $updatedItem['qty'];
                            $pro->product_price = $updatedItem['price'];
                            $pro->status = 2;
                            $pro->save();
                            $listOfItems[] = $pro;

                            $product = Products::find($updatedItem['id']);
                            $avg = $product->purchasesOrders();
                            $totalCost += $avg * $item['qty'];
                            $posSession->cost = $totalCost;
                            $posSession->save();
                        }
                    }
                }
            }
        }

        return redirect()->route('pos.refunds')->with('refunded', $request->sessionId)->with('session', $request->sessionId);
    }

    public function refundAll($sessionId)
    {
        $user = Auth::user();
        $userId = $user->id;

        $posSession = PosSessions::find($sessionId);
        $posSession->status = 2; //refunded
        $posSession->full_refund = 1;
        $posSession->refunded_by = $userId;
        $posSession->refunded_when = Carbon::now();
        $posSession->save();

        $safeId = Safes::where('branch_id', $posSession->branch_id)->value('id');
        $payment = new SafesTransactions();
        $payment->safe_id = $safeId;
        $payment->transaction_type = 1;
        $payment->transaction_amount = $posSession->total;
        $payment->transaction_datetime = Carbon::now();
        $payment->done_by = $posSession->sold_by;
        $payment->transaction_notes = 'مرتجع فاتورة بيع سريع رقم' . $sessionId;
        $payment->authorized_by = $posSession->sold_by;
        $payment->save();

        Safes::where('id', $safeId)->decrement('safe_balance', $posSession->total);

        $items = Cart::where('pos_session_id', $sessionId)->get();
        foreach ($items as $item) {
            Products::where('id', $item->product_id)->decrement('product_total_out', $item->product_qty);
            BranchesProducts::where('product_id', $item->product_id)
                ->where('branch_id', $posSession->branch_id)
                ->increment('amount', $item->product_qty);
        }

        Cart::where('pos_session_id', $sessionId)->update([
            'status' => 2
        ]);

        return redirect()->route('pos.refunds')->with('refunded', $sessionId)->with('session', $sessionId);
    }

    public function refundReceipt($sessionId)
    {
        $currentCart = Cart::where('pos_session_id', $sessionId)->where('status', '!=', 2)->get();
        $refundedCart = Cart::where('pos_session_id', $sessionId)->where('status', 2)->get();
        $currentSession = PosSessions::find($sessionId);
        $logo = Settings::where('key', 'logo')->value('value');
        $company = Settings::where('key', 'company_name')->value('value');
        return view('pos.refunded', compact('refundedCart', 'company', 'logo', 'currentCart', 'sessionId', 'currentSession'));
    }

    private function refundable()
    {
        $endedSession = PosSessions::where('status', 1)->get();
        $halfEndedSess = PosSessions::where('status', 2)->where('full_refund', 0)->get();
        return $endedSession->merge($halfEndedSess);
    }
}
