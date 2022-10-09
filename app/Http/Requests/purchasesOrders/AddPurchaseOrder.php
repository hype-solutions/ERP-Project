<?php

namespace App\Http\Requests\purchasesOrders;

use Illuminate\Foundation\Http\FormRequest;

class AddPurchaseOrder extends FormRequest
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
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'product.*.id' => 'nullable|required',
            'product.*.desc' => 'nullable',
            'product.*.price' => 'nullable|required|min:0|numeric',
            'product.*.qty' => 'nullable|required|min:0|numeric',
            'discount_percentage' => 'nullable|min:0|numeric',
            'discount_amount' => 'nullable|min:0|numeric',
            'shipping_fees' => 'nullable|min:0|numeric',
            'tax' => 'nullable|min:0|numeric',
            'payment_method' => 'nullable',
            'safe_id_not_paid' => 'nullable',
            'invoice_note' => 'nullable',

        ];
    }

    public function messages()
    {
        return [
            'product.*.id.required' => 'يجب ادخال منتج واحد على الأقل',
            'supplier_id.required' => 'يجب ادخال مورد',
            'product.*.price.required' => 'يجب ادخال سعر المنتج',
            'product.*.qty.required' => 'يجب ادخال كمية المنتج',
            'discount_percentage.min' => 'يجب أن يكون الخصم أكبر من الصفر',
            'shipping_fees.min' => 'يجب أن يكون الشحن أكبر من الصفر',
        ];
    }
}
