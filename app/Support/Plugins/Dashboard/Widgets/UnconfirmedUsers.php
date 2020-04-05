<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\UserStatus;

class UnconfirmedUsers extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '3';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UnconfirmedUsers constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.unconfirmed-users', [
            'count' => $this->users->countByStatus(UserStatus::UNCONFIRMED)
        ]);
    }
}
