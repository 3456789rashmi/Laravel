<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class NameRuleEi implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // add name rule based validations
        if(empty($value))
        {
            $fail("Name is required");
        }
        $value=trim($value);
        if(!preg_match('/^[ a-zA-Z ]+$/',$value))
            {
                $fail("letters must be entered here");
            }
            if(strlen($value)<3 || strlen($value)>15){
                $fail ("only accepts names between 3 to 15 characters");
            }
    }
}