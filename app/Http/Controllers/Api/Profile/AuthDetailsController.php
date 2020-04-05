<?php

namespace Kouloughli\Http\Controllers\Api\Profile;

use Kouloughli\Events\User\UpdatedProfileDetails;
use Kouloughli\Http\Controllers\Api\ApiController;
use Kouloughli\Http\Requests\User\UpdateProfileDetailsRequest;
use Kouloughli\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Transformers\UserTransformer;

/**
 * Class DetailsController
 * @package Kouloughli\Http\Controllers\Api\Profile
 */
class AuthDetailsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Updates user profile details.
     * @param UpdateProfileLoginDetailsRequest $request
     * @param UserRepository $users
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileLoginDetailsRequest $request, UserRepository $users)
    {
        $user = $request->user();

        $data = $request->only(['email', 'username', 'password']);

        $user = $users->update($user->id, $data);

        return $this->respondWithItem($user, new UserTransformer);
    }
}
