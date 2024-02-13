<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Core\Http\Requests\BaseFormRequest;

class ResetPasswordFormRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'token' => 'bail|required|string|max:255',
            'password' => 'bail|required|string|between:6,20',
        ];
    }
}
