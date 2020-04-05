<?php

namespace Kouloughli\Support\Plugins\Dashboard\Widgets;

use Kouloughli\Plugins\Widget;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\UserStatus;

class BannedUsers extends Widget
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
    protected $users;

    /**
     * BannedUsers constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.banned-users', [
            'count' => $this->users->countByStatus(UserStatus::BANNED)
        ]);
    }
}
