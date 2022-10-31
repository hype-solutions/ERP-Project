<?php

namespace App\Http\Requests\Outs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOutEntities extends FormRequest
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
        $ent = $this->ent;
        return [
            'entity_name' => 'required|unique:out_entities,entity_name,'.$ent->id,
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
            'entity_name.required' => 'برجاء إدخال إسم الجهه',
            'entity_name.unique' => 'برجاء إختيار اسم جهه اخر, هذا الإسم مستخدم بالفعل',
     ];
    }
}
