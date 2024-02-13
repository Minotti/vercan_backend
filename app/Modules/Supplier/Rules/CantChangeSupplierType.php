<?php

namespace App\Modules\Supplier\Rules;

use App\Modules\Supplier\Repositories\SupplierRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CantChangeSupplierType implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ((new SupplierRepository())->find(request()->route()->parameter('id'))?->type != $value) {
            $fail('Não é possível alterar o tipo do fornecedor');
        }
    }
}
