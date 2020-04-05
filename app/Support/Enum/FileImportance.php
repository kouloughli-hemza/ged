<?php

namespace Kouloughli\Support\Enum;

class FileImportance
{
    const SECRET = 'secret';
    const VERYSECRET = 'very secret';
    const URGENT = 'urgent';

    public static function lists()
    {
        return [
            self::SECRET => trans('app.importance.'.self::SECRET),
            self::VERYSECRET => trans('app.importance.'. self::VERYSECRET),
            self::URGENT => trans('app.importance.'. self::URGENT),
        ];
    }


    public static function pageNumbers()
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
        ];
    }
}
