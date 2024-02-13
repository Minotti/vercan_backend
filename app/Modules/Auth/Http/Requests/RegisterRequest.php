<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Core\Http\Requests\BaseFormRequest;
use Illuminate\Support\Str;

class RegisterRequest extends BaseFormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
           'email' => Str::lower($this->email)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|between:6,60',
            'cellphone' => 'required|string|between:6,25',
        ];
    }
}
