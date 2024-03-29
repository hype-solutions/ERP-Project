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
            'branch_id' => 'nullable',
            'customer_id' => 'nullable',
            'sold_by' => 'nullable',
            'invoice_total' => 'nullable',
            'invoice_paper_num' => 'nullable',
            'new_customer_name' => 'nullable',
            'new_customer_mobile' => 'nullable',
            'product.*.id' => 'nullable',
            'product.*.desc' => 'nullable',
            'product.*.price' => 'nullable',
            'product.*.cost' => 'nullable',
            'product.*.qty' => 'nullable',
            'discount_percentage' => 'nullable',
            'discount_amount' => 'nullable',
            'shipping_fees' => 'nullable',
            'tax' => 'nullable',
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
