<?php

namespace App\Http\Controllers;

use App\Models\Products\Products;
use App\Models\Products\ProductsCategories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function list()
    {
        $categories = ProductsCategories::with('product')->get();

        return view('categories.list', compact('categories'));
    }

    public function adding(Request $request)
    {
        $request->validate(
            [
                'category_name' => 'unique:products_categories,cat_name|required',
            ],
            [
                'category_name.unique' => 'هذه الفئة موجودة بالفعل',
            ]
        );


        $cat = new ProductsCategories();
        $cat->cat_name = $request->category_name;
        $cat->save();

        return back()->with('success', 'product category Added');
    }

    public function editing(ProductsCategories $cat, Request $request)

    {
        $request->validate(
            [
                'category_name' => 'unique:products_categories,cat_name,'.$cat->id,
            ]
        );

        $cat->update([
            'cat_name'=>$request->category_name
        ]);
        // = ;
        $cat->save();

        return back()->with('success', 'product category editied');
    }

    public function deleting(ProductsCategories $cat)
    {
        Products::where('product_category', $cat->id)->update([
            'product_category' => null
        ]);
        $cat->delete();

        return back()->with('success', 'product category editied');
    }
}
