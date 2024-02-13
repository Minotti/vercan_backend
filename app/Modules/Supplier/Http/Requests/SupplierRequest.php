<?php

namespace App\Modules\Supplier\Http\Requests;

use App\Modules\Core\Http\Requests\BaseFormRequest;
use App\Modules\Supplier\Enums\SupplierContactEmailEnum;
use App\Modules\Supplier\Enums\SupplierContactPhoneEnum;
use App\Modules\Supplier\Enums\SupplierTypeEnum;
use App\Modules\Supplier\Rules\OneContactAtLeast;
use Illuminate\Validation\Rule;
use JansenFelipe\Utils\Utils;

class SupplierRequest extends BaseFormRequest
{

    protected BaseFormRequest $formRequest;

    public function __construct()
    {
        parent::__construct();

        $this->formRequest = match (request()->get('type')) {
            SupplierTypeEnum::Fisica->value => PFRequest::createFrom(request()),
            default => PJRequest::createFrom(request())
        };
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->formRequest->prepareForValidation();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return array_merge($this->commonRules(), $this->formRequest->rules());
    }

    public function messages(): array
    {
        return array_merge($this->commonMessages(), $this->formRequest->messages());
    }

    public function attributes(): array
    {
        return $this->formRequest->attributes();
    }

    public function commonRules(): array
    {
        return [
            'active' => ['required'],
            'observation' => ['sometimes', 'max:5000'],
            'address' => ['required', 'array'],
            'address.city_id' => ['required', 'exists:cities,id'],
            'address.postcode' => ['required'],
            'address.address' => ['required'],
            'address.district' => ['required'],
            'address.number' => ['required'],
            'address.info' => ['sometimes', 'max:100'],
            'address.complement' => ['max:100'],
            'address.condominium' => ['required', 'boolean'],
            'contacts' => ['array', 'min:1', new OneContactAtLeast()],
            'contacts.*.additional' => ['required', 'boolean'],
            'contacts.*.name' => ['required_if:contacts.*.additional,true', 'max:100'],
            'contacts.*.company' => ['sometimes', 'max:100'],
            'contacts.*.office' => ['sometimes', 'max:60'],
            'contacts.*.contacts.phone' => ['array', 'min:1'],
            'contacts.*.contacts.phone.*.phone' => ['required_if:contacts.*.additional,false', 'celular_com_ddd'],
            'contacts.*.contacts.phone.*.type' => ['required_with:contacts.*.contacts.phone.*.phone,', Rule::enum(SupplierContactPhoneEnum::class)],
            'contacts.*.contacts.email' => ['array'],
            'contacts.*.contacts.email.*.email' => ['nullable', 'email:rfc,dns'],
            'contacts.*.contacts.email.*.type' => ['required_with:contacts.*.contacts.email.*.email,', Rule::enum(SupplierContactEmailEnum::class)]
        ];
    }

    public function commonMessages(): array
    {
        return [
            'contacts.*.name.required_if' => 'O campo :attribute é obrigatório',
            'contacts.*.contacts.phone.*.phone.required_if' => 'É obrigatório informar ao menos um telefone',
            'contacts.*.contacts.phone.*.type.required_with' => 'É obrigatório informar o Tipo de Contato',
            'contacts.*.contacts.*.*.type.in' => 'O Tipo de Contato é inválido',
        ];
    }
}
