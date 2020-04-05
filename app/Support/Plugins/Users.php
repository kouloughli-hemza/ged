<?php

namespace Kouloughli\Support\Plugins;

use Kouloughli\Plugins\Plugin;
use Kouloughli\Support\Sidebar\Item;

class Users extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Users'))
            ->route('users.index')
            ->icon('users')
            ->active("users*")
            ->permissions('users.manage');
    }
}
