<?php

namespace Kouloughli\Http\Requests\Direction;

use Kouloughli\Http\Requests\Request;

class RemoveDirectionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $direction = $this->route('direction');
        return $direction->id_direc == 1 ? false : true;
    }

    public function rules()
    {
        return [];
    }
}
