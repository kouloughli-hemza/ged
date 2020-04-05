<?php

namespace Kouloughli\Support\Plugins;

use Kouloughli\Plugins\Plugin;
use Kouloughli\Support\Sidebar\Item;

class Files extends Plugin
{
    /**
     * @return Item|mixed|null
     */
    public function sidebar()
    {
        return Item::create(__('Documents'))
            ->route('files.index')
            ->icon('users')
            ->active("files*")
            ->permissions('files.create');
    }
}
