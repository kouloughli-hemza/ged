<?php

namespace Kouloughli\Events\Direction;

use Kouloughli\Direction;

abstract class DirectionEvent
{
    /**
     * @var Direction
     */
    protected $direction;

    public function __construct(Direction $direction)
    {
        $this->direction = $direction;
    }

    /**
     * @return Direction
     */
    public function getDirection()
    {
        return $this->direction;
    }
}