<?php

namespace Kouloughli\Support\Plugins\Dashboard;

use Kouloughli\Plugins\Plugin;
use Kouloughli\Support\Sidebar\Item;

class Dashboard extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Dashboard'))
            ->route('dashboard')
            ->icon('home')
            ->active("/");
    }
}
