<?php

namespace App\Http\Requests\Outs;

use Illuminate\Foundation\Http\FormRequest;

class CreateOutEntities extends FormRequest
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
            'entity_name' => 'required|unique:out_entities',
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
            'entity_name.required' => 'برجاء إدخال إسم الجهه',
            'entity_name.unique' => 'برجاء إختيار اسم جهه اخر, هذا الإسم مستخدم بالفعل',
        ];
    }
}