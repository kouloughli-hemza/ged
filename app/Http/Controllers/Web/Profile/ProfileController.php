<?php

namespace Kouloughli\Http\Controllers\Web\Profile;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Kouloughli\Http\Controllers\Controller;
use Kouloughli\Repositories\Country\CountryRepository;
use Kouloughli\Repositories\Direction\DirectionRepository;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\UserStatus;

/**
 * Class ProfileController
 * @package Kouloughli\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var RoleRepository
     */
    private $roles;
    /**
     * @var CountryRepository
     */
    private $countries;
    /**
     * @var DirectionRepository
     */
    private $directions;

    /**
     * @param UserRepository $users
     * @param RoleRepository $roles
     * @param CountryRepository $countries
     */
    public function __construct(UserRepository $users, RoleRepository $roles, CountryRepository $countries,DirectionRepository $directions)
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->countries = $countries;
        $this->directions = $directions;
    }

    /**
     * Display user's profile page.
     *
     * @return Factory|View
     */
    public function show()
    {
        $roles = $this->roles->all()->filter(function ($role) {
            return $role->id == auth()->user()->role_id;
        })->pluck('name', 'id');

        return view('user.profile', [
            'user' => auth()->user(),
            'edit' => true,
            'roles' => $roles,
            'directions' => $this->directions->lists(),
            'countries' => [0 => __('Select a Country')] + $this->countries->lists()->toArray(),
            'socialLogins' => $this->users->getUserSocialLogins(auth()->id()),
            'statuses' => UserStatus::lists()
        ]);
    }
}
