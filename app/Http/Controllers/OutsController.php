<?php

namespace App\Http\Controllers;

use App\Models\Out\Out;
use App\Models\Out\OutCategories;
use App\Models\Out\OutEntities;
use Illuminate\Http\Request;

class OutsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('log')->only('index');

        // $this->middleware('subscribed')->except('store');
    }

    public function outsList()
    {
        $outs = Out::all();
        return view('outs.list', compact('outs'));
    }

    public function entities()
    {
        $entities = OutEntities::all();
        return view('outs.entities', compact('entities'));
    }

    public function categories()
    {
        $cats = OutCategories::all();
        return view('outs.categories', compact('cats'));
    }
}
