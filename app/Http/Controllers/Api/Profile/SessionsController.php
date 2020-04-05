<?php

namespace Kouloughli\Http\Controllers\Api\Profile;

use Kouloughli\Http\Controllers\Api\ApiController;
use Kouloughli\Repositories\Session\SessionRepository;
use Kouloughli\Transformers\SessionTransformer;

/**
 * Class DetailsController
 * @package Kouloughli\Http\Controllers\Api\Profile
 */
class SessionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('session.database');
    }

    /**
     * Handle user details request.
     * @param SessionRepository $sessions
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(SessionRepository $sessions)
    {
        $sessions = $sessions->getUserSessions(auth()->id());

        return $this->respondWithCollection(
            $sessions,
            new SessionTransformer
        );
    }
}
