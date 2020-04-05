<?php
/**
 * Created by PhpStorm.
 * User: kouloughli
 * Date: 3/27/20
 * Time: 5:35 PM
 */

namespace Kouloughli\Presenters;

use Kouloughli\Support\Enum\FileImportance;

class FileImportancePresenter extends Presenter
{
    /**
     * Determine css class used for Importance labels
     * inside the File table by checking File Importance.
     *
     * @return string
     */
    public function labelClass()
    {
        switch ($this->model->importance) {
            case FileImportance::VERYSECRET:
                $class = 'danger';
                break;

            case FileImportance::SECRET:
                $class = 'warning';
                break;

            default:
                $class = 'primary';
        }

        return $class;
    }

}