<?php

namespace Kouloughli\Http\Requests\Auth;

use Kouloughli\Http\Requests\Request;

class PasswordResetRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ];
    }

    /**
     * Get the password reset fields.
     *
     * @return array
     */
    public function credentials()
    {
        return $this->only('email', 'password', 'password_confirmation', 'token');
    }
}
