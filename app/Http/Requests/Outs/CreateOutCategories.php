<?php

namespace App\Http\Requests\Outs;

use Illuminate\Foundation\Http\FormRequest;

class CreateOutCategories extends FormRequest
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
            'category_name' => 'required|unique:out_categories',
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
            'category_name.required' => 'برجاء إدخال إسم الفئة',
            'category_name.unique' => 'برجاء إختيار اسم بند اخر, هذا الإسم مستخدم بالفعل',


        ];
    }
}
