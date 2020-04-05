<?php

namespace Kouloughli\Http\Requests\Role;

use Kouloughli\Http\Requests\Request;

class UpdateRoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $role = $this->route('role');
        return [
            'role_name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|unique:roles,role_name,' . $role->ref_role . ',ref_role',
        ];
    }
}
