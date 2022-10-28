<?php

namespace App\Http\Requests\Ins;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInCategories extends FormRequest
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
        $cat = $this->cat;
        return [
            'category_name' => 'required|unique:in_categories,category_name,'.$cat->id,
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
            'category_name.required' => 'برجاء إدخال إسم الفئة',
            'category_name.unique' => 'برجاء إختيار اسم بند اخر, هذا الإسم مستخدم بالفعل',
     ];
    }
}
