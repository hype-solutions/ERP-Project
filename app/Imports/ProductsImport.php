<?php

namespace App\Imports;

use App\Models\Products\Products;
use App\Models\Products\ProductsCategories;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $getBrand = $row['0'];
        $getCode = $row['2'];
        $getProduct = $row['3'];
        $getDetails = $row['4'];
        $getCategory = $row['6'];
        $dontAdd = 0;

        if ($row[3]) {

            $searchProducts = Products::where('product_name', $getProduct)->get();
            foreach ($searchProducts as $key => $product) {
                if ($product->product_code ==  $getCode) {
                    $dontAdd = 1;
                }
            }
            if ($dontAdd == 0) {

                if ($getCategory) {
                    $searchCategories = ProductsCategories::where('cat_name', $getCategory)->get();

                    if (!$searchCategories->isEmpty()) {
                        $catId = $searchCategories->first()->id;
                    } else {
                        $newCat = new ProductsCategories();
                        $newCat->cat_name = $getCategory;
                        $newCat->save();

                        $catId = $newCat->id;
                    }
                } else {
                    $catId = '';
                }

                return new Products([
                    'product_brand'     => $getBrand,
                    'product_code'    => $getCode,
                    'product_name'    => $getProduct,
                    'product_desc'    => $getDetails,
                    'product_category'    => $catId,
                ]);
            }
        }
    }


    // public function uniqueBy()
    // {
    //     return 'product_name';
    // }
}
