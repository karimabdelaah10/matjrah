<?php


namespace App\Modules\Users\Requests;
use App\Modules\BaseApp\Requests\BaseAppRequest;
use App\Modules\Users\Enums\CustomersEnum;
use App\Rules\Mobile;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseAppRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');
        $rules = [
            'first_name' => 'required|regex:/^[\pL\s\d]+$/u|max:191|min:3',
            'last_name' => 'required|regex:/^[\pL\s\d]+$/u|max:191|min:3',
            'email' => [
                
                Rule::unique('users')->where(function ($query) use ($id){
                    return $query->where('id' , '!=' , $id)->where('deleted_at', null);
                }),
                'email'
            ],
            'mobile_number' => [
                
                Rule::unique('users')->where(function ($query) use ($id){
                    return $query->where('id' , '!=' , $id)->where('deleted_at', null);
                }),
                new Mobile
            ],
            'password' => ['nullable', 'regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[~@#\$%\^&\*_\-\+=`|{}:;!\.\?\"()\[\]]).{8,25})$/', 'confirmed']
        ];

        $customer_rules = [
            "gender_id"             =>  "required|exists:options,id",
            "marital_status"        =>  "required|exists:options,id",
            "nationality_id"        =>  "required|exists:countries,id",
            "national_id"           =>  "required|digits:14",
            "national_id_image_front"     =>  "nullable|image",
            "national_id_image_back"     =>  "nullable|image",

            "work_type"             =>  ["required",Rule::in(CustomersEnum::workTypes())],
            "job_title"             =>  "required|min:3",
            "company_name"          =>  "required|min:3",
            "company_address"       =>  "required",
            "employment_document"   =>  "nullable|image",
            "utility_bill"          =>  "nullable|image",
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
