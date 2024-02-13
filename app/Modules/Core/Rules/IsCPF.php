<?php

namespace App\Modules\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use JansenFelipe\Utils\Utils;

class IsCPF implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Utils::isCpf($value)) {
            $fail('O campo :attribute deve conter um CPF válido.');
        }
    }
}
