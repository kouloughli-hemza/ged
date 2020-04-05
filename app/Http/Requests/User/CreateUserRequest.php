<?php

namespace Kouloughli\Http\Requests\User;

use Kouloughli\Http\Requests\Request;
use Kouloughli\User;

class CreateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'username' => 'nullable|unique:users,username',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,ref_role',
            'id_direc' => 'required|exists:directions,id_direc',
            'verified' => 'boolean'
        ];

        return $rules;
    }
}
