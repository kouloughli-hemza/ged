<?php

namespace Kouloughli\Http\Requests\User;

use Kouloughli\Http\Requests\Request;
use Kouloughli\User;

class UpdateLoginDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->getUserForUpdate();

        return [
            'email' => 'required|email|unique:users,email,' . $user->ref_user . ',ref_user',
            'username' => 'nullable|unique:users,username,' . $user->ref_user . ',ref_user',
            'password' => 'nullable|min:8|confirmed'
        ];
    }

    /**
     * @return \Illuminate\Routing\Route|object|string
     */
    protected function getUserForUpdate()
    {
        return $this->route('user');
    }
}
