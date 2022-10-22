<?php

namespace App\Http\Requests\Ins;

use Illuminate\Foundation\Http\FormRequest;

class CreateIns extends FormRequest
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
            'cat_id' => 'nullable',
            'safe_id' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric',
            'notes' => 'nullable',
        ];
    }


    /**
     * define the error messages for each input.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'safe_id.required' => 'برجاء إختيار خزنة',
            'date.required' => 'برجاء إدخال تاريخ',
            'amount.required' => 'برجاء إدخال المبلغ',
            'amount.numeric' => 'خانه المبلغ تقبل الأرقام فقط',
        ];
    }
}
