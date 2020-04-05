<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Kouloughli\Plugins\Widget;
use Kouloughli\User;

class UserActions extends Widget
{
    /**
     * UserActions constructor.
     */
    public function __construct()
    {
        $this->permissions(function (User $user) {
            return $user->hasRole('User');
        });
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.user-actions');
    }
}
