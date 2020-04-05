<?php

namespace Kouloughli\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Kouloughli\Events\User\Banned;
use Kouloughli\Events\User\LoggedIn;
use Kouloughli\Listeners\Users\ActivateUser;
use Kouloughli\Listeners\Users\InvalidateSessionsAndTokens;
use Kouloughli\Listeners\Login\UpdateLastLoginTimestamp;
use Kouloughli\Listeners\Registration\SendSignUpNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendSignUpNotification::class,
        ],
        LoggedIn::class => [
            UpdateLastLoginTimestamp::class
        ],
        Banned::class => [
            InvalidateSessionsAndTokens::class
        ],
        Verified::class => [
            ActivateUser::class
        ]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        //
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
