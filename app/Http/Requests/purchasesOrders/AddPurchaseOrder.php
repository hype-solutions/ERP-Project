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
            'branch_id' => 'nullable',
            'customer_id' => 'nullable',
            'sold_by' => 'nullable',
            'invoice_total' => 'nullable',
            'invoice_paper_num' => 'nullable',
            'new_customer_name' => 'nullable',
            'new_customer_mobile' => 'nullable',
            'product.*.id' => 'nullable',
            'product.*.desc' => 'nullable',
            'product.*.price' => 'nullable|required|min:0|numeric',
            'product.*.cost' => 'nullable',
            'product.*.qty' => 'nullable',
            'discount_percentage' => 'nullable|min:0|numeric',
            'discount_amount' => 'nullable',
            'shipping_fees' => 'nullable|min:0|numeric',
            'tax' => 'nullable|min:0|numeric',
            'payment_method' => 'nullable',
            'safe_id_not_paid' => 'nullable',
            'invoice_note' => 'nullable',
            'later.*.amount' => 'nullable',
            'later.*.date' => 'nullable',
            'later.*.notes' => 'nullable',
            'later.*.paynow' => 'nullable',

        ];
    }
}
