<?php

namespace Kouloughli\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Kouloughli\Direction;
use Kouloughli\Observers\DirectionObserver;
use Kouloughli\Repositories\Country\CountryRepository;
use Kouloughli\Repositories\Country\EloquentCountry;
use Kouloughli\Repositories\Direction\DirectionRepository;
use Kouloughli\Repositories\Direction\EloquentDirection;
use Kouloughli\Repositories\File\EloquentFile;
use Kouloughli\Repositories\File\FileRepository;
use Kouloughli\Repositories\Permission\EloquentPermission;
use Kouloughli\Repositories\Permission\PermissionRepository;
use Kouloughli\Repositories\Role\EloquentRole;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\Session\DbSession;
use Kouloughli\Repositories\Session\SessionRepository;
use Kouloughli\Repositories\User\EloquentUser;
use Kouloughli\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        config(['app.name' => setting('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);
        Direction::observe(DirectionObserver::class);

        Validator::extend('pdf', function($attribute, $value, $parameters) {
            $allowed_mimes = [
                'application/pdf', // pdf
            ];
            return in_array($value->getMimeType(), $allowed_mimes);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);
        $this->app->singleton(DirectionRepository::class, EloquentDirection::class);
        $this->app->singleton(FileRepository::class, EloquentFile::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
