<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CompanyUniqueName;
use App\Models\Companies\Company; 

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'company_name' => ['required', 'string',  new CompanyUniqueName],
            'company_address' => ['required', 'string'],
            'company_phone' => ['required', 'numeric'],
            'no_of_staff' => ['required', 'numeric', 'min:1',],
            'about_company' => ['required', 'string'],
            'services' => ['required', 'string'],
            'company_email' => "nullable",
        ];

        if (request()->user()->isSuperAdmin()) {
            $rules['admin_name'] = [ 
                'nullable',
                 Rule::requiredIf(!request()->user()->isSuperAdmin),
                'string'
            ];
            $rules['admin_email'] = [ 
                'nullable',
                 Rule::requiredIf(!request()->user()->isSuperAdmin),
                'string'
            ];
            $rules['admin_user'] = [ 
                'nullable',
                 Rule::requiredIf(!request()->user()->isSuperAdmin),
                'string'
            ];

            $rules['RC_number'] = [ 
                'nullable',
                Rule::excludeIf(function () {
                    return $this->user()->isSuperAdmin();
                }),
                'numeric'
            ];

        }

        return $rules;
    }

    /**
     * Add custom validation logic.
     *
     * @param \Illuminate\Validation\Validator $validator
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if the company_name already exists in the database
            $companyNameExists = Company::where('company_email', $this->input('company_email'))->exists();

            if ($companyNameExists) {
                $validator->errors()->add('company_email', 'The company email already exists.');
            }
        });
    }


}

/*
Rule::requiredIf(function () {
    return !$this->user()->isSuperAdmin();
}),
*/
//  Rule::requiredIf(request()->user()->isAdmin()),
//'role_id' => Rule::excludeIf($request->user()->is_admin),