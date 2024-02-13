<?php

namespace App\Modules\Supplier\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OneContactAtLeast implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (collect($value)->filter(fn ($contact) => !$contact['additional'])->isEmpty()) {
            $fail('É obrigatório informar ao menos um telefone para o Fornecedor.');
        }
    }
}
