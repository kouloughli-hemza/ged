<?php

namespace Kouloughli\Http\Controllers\Api\Profile;

use Kouloughli\Events\User\UpdatedProfileDetails;
use Kouloughli\Http\Controllers\Api\ApiController;
use Kouloughli\Http\Requests\User\UpdateProfileDetailsRequest;
use Kouloughli\Repositories\User\UserRepository;
use Kouloughli\Transformers\UserTransformer;

/**
 * Class DetailsController
 * @package Kouloughli\Http\Controllers\Api\Profile
 */
class DetailsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle user details request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithItem(
            auth()->user(),
            new UserTransformer
        );
    }

    /**
     * Updates user profile details.
     * @param UpdateProfileDetailsRequest $request
     * @param UserRepository $users
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileDetailsRequest $request, UserRepository $users)
    {
        $user = $request->user();

        $data = collect($request->all());

        $data = $data->only([
            'first_name', 'last_name', 'birthday',
            'phone', 'address', 'country_id'
        ])->toArray();

        if (! isset($data['country_id'])) {
            $data['country_id'] = $user->country_id;
        }

        $user = $users->update($user->id, $data);

        event(new UpdatedProfileDetails);

        return $this->respondWithItem($user, new UserTransformer);
    }
}
