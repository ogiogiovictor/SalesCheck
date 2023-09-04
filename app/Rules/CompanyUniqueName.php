<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Companies\Company; // Adjust this namespace according to your actual Company model namespace

class CompanyUniqueName implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

     /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if a company with the same name exists in the database
        return !Company::where('company_name', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @param  string  $attribute
     * @return string
     */
    public function message()
    {
        return 'The company name already exists.';
    }
}
