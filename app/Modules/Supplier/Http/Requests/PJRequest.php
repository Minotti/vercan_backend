<?php

namespace App\Modules\Supplier\Http\Requests;

use App\Modules\Core\Http\Requests\BaseFormRequest;
use App\Modules\Supplier\Enums\SupplierIeIndicatorEnum;
use App\Modules\Supplier\Enums\SupplierTypeEnum;
use App\Modules\Core\Rules\IsCNPJ;
use App\Modules\Supplier\Enums\SupplierTypeGatheringEnum;
use App\Modules\Supplier\Rules\CantChangeSupplierType;
use Illuminate\Validation\Rule;
use JansenFelipe\Utils\Utils;

class PJRequest extends BaseFormRequest
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
            'rg' => Utils::unmask($this->get('rg')),
            'ie' => Utils::unmask($this->get('ie')),
            'im' => Utils::unmask($this->get('im')),
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
                'required', Rule::in([SupplierTypeEnum::Juridica->value]),
                Rule::when($this->method() == 'PUT', [new CantChangeSupplierType()])
            ],
            'legal_name' => ['required', 'max:254'],
            'trade_name' => ['required', 'max:254'],
            'cpf_cnpj' => ['required', new IsCNPJ()],
            'ie_indicator' => ['required', Rule::enum(SupplierIeIndicatorEnum::class)],
            'ie' => ['max:50', 'required_unless:ie_indicator,' . SupplierIeIndicatorEnum::NaoContribuinte->value],
            'im' => ['max:50'],
            'gathering' => ['required', Rule::enum(SupplierTypeGatheringEnum::class)],
        ];
    }

    public function attributes()
    {
        return [
            'cpf_cnpj' => 'CNPJ'
        ];
    }

    public function messages()
    {
        return [
            'type.in' => 'O valor para tipo de pessoa é inválido',
            'ie.required_unless' => 'A campo :attribute é obrigatório'
        ];
    }
}
