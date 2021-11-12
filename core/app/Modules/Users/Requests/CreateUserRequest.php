<?php

namespace App\Modules\Users\Requests;

use App\Modules\Users\Enums\CustomersEnum;
use App\Rules\Mobile;
use Carbon\Carbon;
use App\Modules\Users\User;
use Illuminate\Validation\Rule;
use App\Modules\Users\UserEnums;
use Illuminate\Support\Facades\Auth;
use App\Modules\BaseApp\Requests\BaseAppRequest;

class CreateUserRequest extends BaseAppRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'first_name' => 'required|regex:/^[\pL\s\d]+$/u|max:191|min:3',
            'last_name' => 'required|regex:/^[\pL\s\d]+$/u|max:191|min:3',
            'email' => [
                'required',
                'nullable',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
                'email'
            ],
            'mobile_number' => [
                'required',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
                new Mobile
            ],
            'password' => ['required', 'regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[~@#\$%\^&\*_\-\+=`|{}:;!\.\?\"()\[\]]).{8,25})$/', 'confirmed']
        ];

        $customer_rules = [
            "gender_id"             =>  "required|exists:options,id",
            "marital_status"        =>  "required|exists:options,id",
            "nationality_id"        =>  "required|exists:countries,id",
            "national_id"           =>  "required|digits:14",
            "national_id_image_front"     =>  "required|image",
            "national_id_image_back"     =>  "required|image",

            "work_type"             =>  ["required",Rule::in(CustomersEnum::workTypes())],
            "job_title"             =>  "required|min:3",
            "company_name"          =>  "required|min:3",
            "company_address"       =>  "required",
            "employment_document"   =>  "required|image",
            "utility_bill"          =>  "required|image",
        ];

        if ($this->type == 'customer') {
            return array_merge($rules, $customer_rules);
        }

        return $rules;
    }

    /**
     * Edit some user data before validation
     * @return void
     */
    protected function prepareForValidation()
    {

    }
    public function messages()
    {
        return[
            'password.regex' => trans('validation.password invalid regex'),
        ];
    }
}
