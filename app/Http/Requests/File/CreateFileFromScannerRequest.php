<?php

namespace Kouloughli\Http\Requests\File;

use Kouloughli\Http\Requests\Request;

class CreateFileFromScannerRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'objet' => 'required',
            'expiditeur' => 'required',
            'destinataire' => 'required',
            'date_arrivee' => 'required|date|before_or_equal:today',
            'nombre_page' => 'required',
            'blob' => 'required',
        ];
    }
}
