<?php

namespace Kouloughli\Http\Controllers\Web\Users;

use Illuminate\Http\Request;
use Kouloughli\Events\User\Banned;
use Kouloughli\Events\User\UpdatedByAdmin;
use Kouloughli\Http\Controllers\Controller;
use Kouloughli\Http\Requests\User\UpdateDetailsRequest;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Support\Enum\UserStatus;
use Kouloughli\User;

/**
 * Class UserDetailsController
 * @package Kouloughli\Http\Controllers\Users
 */
class DetailsController extends Controller
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
     * Updates user details.
     *
     * @param User $user
     * @param UpdateDetailsRequest $request
     * @return mixed
     */
    public function update(User $user, UpdateDetailsRequest $request)
    {
        $data = $request->all();

        if (! data_get($data, 'country_id')) {
            $data['country_id'] = null;
        }

        $this->users->update($user->ref_user, $data);
        $this->users->setRole($user->ref_user, $request->role_id);

        event(new UpdatedByAdmin($user));

        // If user status was updated to "Banned",
        // fire the appropriate event.
        if ($this->userWasBanned($user, $request)) {
            event(new Banned($user));
        }

        return redirect()->back()
            ->withSuccess(__('User updated successfully.'));
    }

    /**
     * Check if user is banned during last update.
     *
     * @param User $user
     * @param Request $request
     * @return bool
     */
    private function userWasBanned(User $user, Request $request)
    {
        return $user->status != $request->status
            && $request->status == UserStatus::BANNED;
    }
}
