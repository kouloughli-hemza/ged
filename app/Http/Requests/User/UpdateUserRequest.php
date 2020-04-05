<?php

namespace Kouloughli\Http\Requests\User;

use Illuminate\Validation\Rule;
use Kouloughli\Http\Requests\Request;
use Kouloughli\Support\Enum\UserStatus;
use Kouloughli\User;

class UpdateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();

        return [
            'email' => 'email|unique:users,email,' . $user->id,
            'username' => 'nullable|unique:users,username,' . $user->id,
            'password' => 'min:6|confirmed',
            'role_id' => 'exists:roles,ref_role',
            'id_direc' => 'exists:directions,id_direc',
            'status' => Rule::in(array_keys(UserStatus::lists()))
        ];
    }
}
