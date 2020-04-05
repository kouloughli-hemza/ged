<?php

namespace Kouloughli\Http\Controllers\Web\Users;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Kouloughli\Events\User\Deleted;
use Kouloughli\Http\Controllers\Controller;
use Kouloughli\Http\Requests\User\CreateUserRequest;
use Kouloughli\Repositories\Activity\ActivityRepository;
use Kouloughli\Repositories\Country\CountryRepository;
use Kouloughli\Repositories\Direction\DirectionRepository;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\UserStatus;
use Kouloughli\User;

/**
 * Class UsersController
 * @package Kouloughli\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display paginated list of all users.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $users = $this->users->paginate($perPage = 20, $request->search, $request->status);

        $statuses = ['' => __('All')] + UserStatus::lists();

        return view('user.list', compact('users', 'statuses'));
    }

    /**
     * Displays user profile page.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('user.view', compact('user'));
    }

    /**
     * Displays form for creating a new user.
     *
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return Factory|View
     */
    public function create(CountryRepository $countryRepository, RoleRepository $roleRepository,DirectionRepository $directionRepository)
    {
        return view('user.add', [
            'countries' => $this->parseCountries($countryRepository),
            'roles' => [0 => __('Select a Role')] + $roleRepository->lists()->toArray(),
            'statuses' => UserStatus::lists(),
            'directions' => [0 => __('Select a Direction')] + $directionRepository->lists()->toArray(),

        ]);
    }

    /**
     * Parse countries into an array that also has a blank
     * item as first element, which will allow users to
     * leave the country field unpopulated.
     *
     * @param CountryRepository $countryRepository
     * @return array
     */
    private function parseCountries(CountryRepository $countryRepository)
    {
        return [0 => __('Select a Country')] + $countryRepository->lists()->toArray();
    }

    /**
     * Stores new user into the database.
     *
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function store(CreateUserRequest $request)
    {
        // When user is created by administrator, we will set his
        // status to Active by default.
        $data = $request->all() + [
            'status' => UserStatus::ACTIVE,
            'email_verified_at' => now()
        ];

        if (! data_get($data, 'country_id')) {
            $data['country_id'] = null;
        }

        // Username should be updated only if it is provided.
        if (! data_get($data, 'username')) {
            $data['username'] = null;
        }

        $this->users->create($data);

        return redirect()->route('users.index')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Displays edit user form.
     *
     * @param User $user
     * @param CountryRepository $countryRepository
     * @param RoleRepository $roleRepository
     * @return Factory|View
     */
    public function edit(User $user, CountryRepository $countryRepository, RoleRepository $roleRepository,DirectionRepository $directionRepository)
    {
        return view('user.edit', [
            'edit' => true,
            'user' => $user,
            'countries' => $this->parseCountries($countryRepository),
            'roles' => $roleRepository->lists(),
            'statuses' => UserStatus::lists(),
            'directions' => $directionRepository->lists(),
            'socialLogins' => $this->users->getUserSocialLogins($user->id)
        ]);
    }

    /**
     * Removes the user from database.
     *
     * @param User $user
     * @return $this
     */
    public function destroy(User $user)
    {
        if ($user->is(auth()->user())) {
            return redirect()->route('users.index')
                ->withErrors(__('You cannot delete yourself.'));
        }

        if($user->direction->users->count() < 2){
            return redirect()->route('users.index')
                ->withErrors(__('This user is the only user for direction :direction , you will have to delete the direction :direction instead.',['direction' => $user->direction->direc_name]) );
        }

        $this->users->delete($user->ref_user);

        event(new Deleted($user));

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }
}
