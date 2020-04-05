<?php

namespace Kouloughli\Http\Requests\User;

use Kouloughli\Http\Requests\Request;
use Kouloughli\User;

class UpdateProfileDetailsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthday' => 'nullable|date',
        ];
    }
}
