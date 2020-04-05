<?php

namespace Kouloughli\Http\Requests\Permission;

use Illuminate\Validation\Rule;
use Kouloughli\Rules\ValidPermissionName;

class CreatePermissionRequest extends BasePermissionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'perm_name' => [
                'required',
                new ValidPermissionName,
                Rule::unique('permissions', 'perm_name')
            ]
        ];
    }
}
