<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProduct extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
      
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product = $this->product;

        return [
            'product_code' => 'required|unique:products,product_code,'. $product->id,
            'product_category' => '',
            'product_sub_category' => '',
            'product_name' => 'required|max:255',
            'product_price' => 'required|min:0|numeric',
            'product_total_in' => '',
            'product_total_out' => '',
            'product_desc' => '',
            'product_brand' => '',
            'product_track_stock' => '',
            'product_low_stock_thershold' => '',
            'product_notes' => '',
        ];
    }

    /**
     * Set the validation messages
     *
     * @return array
     */
    public function messages()
    {
     return [
        'product_code.required' => 'كود المنتج مطلوب',
        'product_code.unique' => 'برجاء إختيار كود اخر, هذا الكود مستخدم بالفعل',
        'product_name.required' => 'برجاء ادخال اسم المنتج',
        'product_price.required' => 'برجاء ادخال سعر المنتج',
     ];
    }
}
