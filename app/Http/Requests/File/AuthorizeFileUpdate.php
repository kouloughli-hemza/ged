<?php

namespace Kouloughli\Http\Requests\File;

use Kouloughli\Http\Requests\Request;

class AuthorizeFileUpdate extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $direction = auth()->user()->direction;
        $fileDirection = $this->route()->parameter('file')->user->direction;

        return $direction->id_direc == $fileDirection->id_direc || auth()->user()->hasRole('Admin')  ? true : false;
    }

    public function rules()
    {
        return [];
    }
}
