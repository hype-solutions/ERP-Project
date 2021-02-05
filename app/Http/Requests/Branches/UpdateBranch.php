<?php

namespace App\Http\Requests\Branches;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBranch extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->can('Edit Branches')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $branch = $this->branch;

        return [
            'branch_name' => 'required|'.Rule::unique('branches')->ignore($branch),
            'branch_mobile' => 'numeric|required|'.Rule::unique('branches')->ignore($branch),
            'branch_phone' => 'numeric|nullable|'.Rule::unique('branches')->ignore($branch),
            'branch_address' => 'nullable',
            'branch_email' => 'nullable|email|'.Rule::unique('branches')->ignore($branch),
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
        'branch_name.required' => 'برجاء إدخال إسم الفرع',
        'branch_name.unique' => 'برجاء إختيار إسم فرع أخر, هذا الإسم مأخوذ بالفعل',
        'branch_mobile.required' => 'برجاء إدخال رقم موبايل الفرع',
        'branch_mobile.unique' => 'هذا الرقم مستخدم بالفعل, برجاء اختيار رقم موبايل اخر',
        'branch_mobile.numeric' => 'رقم الموبايل يجب أن يتكون من أرقام فقط',
        'branch_phone.numeric' => 'رقم التليفون يجب أن يتكون من أرقام فقط',
        'branch_email.email' => 'برجاء إدخال بريد الكتروني صحيح',
        'branch_email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل, برجاء إدخال بريد أخر',
     ];
    }
}
