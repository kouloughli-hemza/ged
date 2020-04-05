<?php

namespace Kouloughli\Http\Controllers\Web\Users;

use Kouloughli\Events\User\UpdatedByAdmin;
use Kouloughli\Http\Controllers\Controller;
use Kouloughli\Http\Requests\User\UpdateLoginDetailsRequest;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\User;

/**
 * Class UserDetailsController
 * @package Kouloughli\Http\Controllers\Users
 */
class LoginDetailsController extends Controller
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
     * Update user's login details.
     *
     * @param User $user
     * @param UpdateLoginDetailsRequest $request
     * @return mixed
     */
    public function update(User $user, UpdateLoginDetailsRequest $request)
    {
        $data = $request->all();

        if (! $data['password']) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update($user->ref_user, $data);

        event(new UpdatedByAdmin($user));

        return redirect()->route('users.edit', $user->ref_user)
            ->withSuccess(__('Login details updated successfully.'));
    }
}
