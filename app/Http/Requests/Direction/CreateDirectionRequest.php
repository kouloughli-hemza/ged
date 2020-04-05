<?php

namespace Kouloughli\Http\Requests\Direction;

use Kouloughli\Http\Requests\Request;

class CreateDirectionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'direc_name' => 'required|regex:/^[a-zA-Z \-_\.]+$/|unique:directions,direc_name',
            'direc_phone' => 'required|regex:/\b\d{9}\b/|unique:directions,direc_phone',
            'direc_email' => 'nullable|email|unique:directions,direc_email',
            'email' => 'required|email|unique:users,email',
            'username' => 'nullable|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
