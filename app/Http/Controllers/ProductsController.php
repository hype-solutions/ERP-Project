<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validatePostRequest()
    {
        return request()->validate([
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
        ]
    );
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
        $product = Products::find($product);
        return view('products.profile',compact('product'));
    }
    public function edit(products $product){
        $product = Products::find($product);
        return view('products.edit',compact('product'));
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
        return view('products.list',compact('products'));
    }
}
