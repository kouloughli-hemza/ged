<?php

namespace Kouloughli\Http\Requests\Role;

use Kouloughli\Http\Requests\Request;

class CreateRoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:roles,role_name'
        ];
    }
}
