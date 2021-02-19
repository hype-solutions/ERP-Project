<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class AddInvoice extends FormRequest
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
            'branch_id' => 'required',
            'customer_id' => 'required',
            'sold_by' => 'required',
            'invoice_total' => 'required',
            'invoice_paper_num' => '',
            'new_customer_name' => '',
            'new_customer_mobile' => '',
            'product.*.id' => 'required',
            'product.*.desc' => '',
            'product.*.price' => 'required',
            'product.*.cost' => 'required',
            'product.*.qty' => 'required',
            'discount_percentage' => '',
            'discount_amount' => '',
            'shipping_fees' => '',
            'tax' => '',
            'payment_method' => 'required',
            'safe_id_not_paid' => '',
            'later.*.amount' => '',
            'later.*.date' => '',
            'later.*.notes' => '',
            'later.*.paynow' => '',

        ];
    }
}
