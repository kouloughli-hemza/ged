<?php

namespace Kouloughli\Listeners\Users;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Kouloughli\Events\User\Banned;
use Kouloughli\Events\User\LoggedIn;
use Kouloughli\Repositories\Session\SessionRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Services\Auth\Api\Token;

class InvalidateSessionsAndTokens
{
    /**
     * @var SessionRepository
     */
    private $sessions;

    public function __construct(SessionRepository $sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * Handle the event.
     *
     * @param Banned $event
     * @return void
     */
    public function handle(Banned $event)
    {
        $user = $event->getBannedUser();

        $this->sessions->invalidateAllSessionsForUser($user->id);

        Token::where('user_id', $user->id)->delete();
    }
}
