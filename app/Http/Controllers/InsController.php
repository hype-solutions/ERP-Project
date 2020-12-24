<?php

namespace App\Http\Controllers;

use App\Models\In\In;
use App\Models\In\InCategories;
use Illuminate\Http\Request;

class InsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }

    public function insList()
    {
        $ins = In::all();
        return view('ins.list', compact('ins'));
    }

    public function categories()
    {
        $cats = InCategories::all();
        return view('ins.categories', compact('cats'));
    }
}
