<?php

namespace Kouloughli\Support\Enum;

class DirectionStatus
{
    const ACTIVE = 'Active';
    const NONACTIVE = 'Non Active';

    public static function lists()
    {
        return [
            self::ACTIVE => trans('app.status.'.self::ACTIVE),
            self::NONACTIVE => trans('app.status.'. self::NONACTIVE),
        ];
    }
}
