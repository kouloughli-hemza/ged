<?php

namespace Kouloughli\Support\Plugins;

use Kouloughli\Plugins\Plugin;
use Kouloughli\Support\Sidebar\Item;

class Directions extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Directions'))
            ->route('directions.index')
            ->icon('users')
            ->active("directions*")
            ->permissions('directions.manage');
    }
}
