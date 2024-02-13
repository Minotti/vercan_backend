<?php

namespace App\Modules\Supplier\Http\Requests;

use App\Modules\Core\Http\Requests\BaseFormRequest;
use App\Modules\Core\Rules\IsCPF;
use App\Modules\Supplier\Enums\SupplierTypeEnum;
use App\Modules\Supplier\Rules\CantChangeSupplierType;
use Illuminate\Validation\Rule;
use JansenFelipe\Utils\Utils;

class PFRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        parent::prepareForValidation();

        $this->merge([
            'cpf_cnpj' => Utils::unmask($this->get('cpf_cnpj')),
            'rg' => Utils::unmask($this->get('rg'))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => [
                'required', Rule::in([SupplierTypeEnum::Fisica->value]),
                Rule::when($this->method() == 'PUT', [new CantChangeSupplierType()])
            ],
            'name' => ['required', 'max:254'],
            'nickname' => ['sometimes', 'max:254'],
            'cpf_cnpj' => ['required', 'max:11', new IsCPF()],
            'rg' => ['required', 'max:10'],
        ];
    }

    public function attributes()
    {
        return [
            'cpf_cnpj' => 'CPF'
        ];
    }
}
