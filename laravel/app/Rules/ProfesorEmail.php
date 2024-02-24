<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ProfesorEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emails = [];
        $emails_result = DB::select('select email from profesor');
        foreach ($emails_result as $entry) {
            array_push($emails, $entry->email);
        }

        if(!in_array($value, $emails)) {
            $fail('No estás autorizado a registrarte en esta aplicación');
        }
    }
}
