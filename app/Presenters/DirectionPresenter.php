<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 3/27/20
 * Time: 5:27 PM
 */

namespace Kouloughli\Presenters;

use Kouloughli\Support\Enum\DirectionStatus;

class DirectionPresenter extends Presenter
{
    /**
     * Determine css class used for status labels
     * inside the Direction table by checking Direction status.
     *
     * @return string
     */
    public function labelClass()
    {
        switch ($this->model->direc_status) {
            case DirectionStatus::ACTIVE:
                $class = 'success';
                break;

            case DirectionStatus::NONACTIVE:
                $class = 'danger';
                break;

            default:
                $class = 'warning';
        }

        return $class;
    }

}