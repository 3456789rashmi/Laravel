<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class EmailruleEi implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // set email validation 
        if(empty($value))
            {
                $fail('email should not be empty');
            }
            if(!str_ends_with($value,'@yahoo.in'))
                {
                    $fail("only yahoo.in mails accepted");
                }
    }
}