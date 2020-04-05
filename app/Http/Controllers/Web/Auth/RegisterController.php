<?php

namespace Kouloughli\Http\Controllers\Web\Auth;

use Illuminate\Auth\Events\Registered;
use Kouloughli\Http\Controllers\Controller;
use Kouloughli\Http\Requests\Auth\RegisterRequest;
use Kouloughli\Http\Requests\Direction\ValidateDirectionRequest;
use Kouloughli\Repositories\Direction\DirectionRepository;
use Kouloughli\Repositories\Role\RoleRepository;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\DirectionStatus;
use Kouloughli\Support\Enum\UserStatus;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * Create a new authentication controller instance.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('registration')->only('show', 'register');

        $this->users = $users;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register', [
            'socialProviders' => config('auth.social.providers')
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     * @param RoleRepository $roles
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request, RoleRepository $roles)
    {
        $user = $this->users->create(
            array_merge($request->validFormData(), ['role_id' => $roles->findByName('User')->id])
        );

        event(new Registered($user));

        $message = setting('reg_email_confirmation')
            ? __('Your account is created successfully! Please confirm your email.')
            : __('Your account is created successfully!');

        \Auth::login($user);

        return redirect('/')->with('success', $message);
    }


    /**
     * Handle a registration request for a direction
     * @param RegisterRequest $request
     * @param RoleRepository $roles
     * @param DirectionRepository $directions
     * @return mixed
     */
    public function registerDirection(RegisterRequest $request, RoleRepository $roles,DirectionRepository $directions)
    {
        // When Direction is created by administrator, we will set his
        // status to Active by default.
        $data = $request->all() + [
                'direc_status' => DirectionStatus::NONACTIVE,
                'folder_path' => $directions->generateDirectoryName(),
            ];
        $directions->directionRegistration($data,$roles,$this->users);

        $message = setting('reg_email_confirmation')
            ? __('Your account is created successfully! Please confirm your email.')
            : __('Your account is created successfully!');

        return redirect('/')->withSuccess($message);

    }

}
