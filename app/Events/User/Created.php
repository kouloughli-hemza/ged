<?php

namespace Kouloughli\Events\User;

use Kouloughli\User;

class Created
{
    /**
     * @var User
     */
    protected $createdUser;

    public function __construct(User $createdUser)
    {
        $this->createdUser = $createdUser;
    }

    /**
     * @return User
     */
    public function getCreatedUser()
    {
        return $this->createdUser;
    }
}
