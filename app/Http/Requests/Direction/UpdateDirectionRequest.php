<?php

namespace Kouloughli\Http\Requests\Direction;

use Kouloughli\Http\Requests\Request;

class UpdateDirectionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $direction = $this->route('direction');
        return [
            'direc_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:directions,direc_name,' . $direction->id_direc . ',id_direc',
            'direc_phone' => 'required|regex:/\b\d{9}\b/|unique:directions,direc_phone,' . $direction->direc_phone . ',direc_phone',
            'direc_email' => 'nullable|email|unique:directions,direc_email,' . $direction->direc_email . ',direc_email',
        ];
    }
}
