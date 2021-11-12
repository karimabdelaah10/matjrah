<?php

namespace App\Modules\Company\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        $id=null;
        if (request()->route()->id){
            $id =request()->route()->id;
        }
        return [
            'name'=>'required|min:3|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number'=>'required',
            'address'=>'required',
            'password'=>'nullable|confirmed',
        ];
    }
}
