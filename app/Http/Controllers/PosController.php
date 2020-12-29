<?php

namespace App\Http\Controllers;

use App\Models\Products\Products;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }
    public function index()
    {
        $products = Products::all();
        return view('pos.index',compact('products'));
    }
}
