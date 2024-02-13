<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Core\Http\Requests\BaseFormRequest;
use Illuminate\Support\Str;

class ForgotPasswordFormRequest extends BaseFormRequest
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
            'email' => 'bail|required|string|email|max:100',
            'back_link' => 'bail|required|string|max:255'
        ];
    }
}
