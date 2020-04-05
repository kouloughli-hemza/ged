<?php

namespace Kouloughli\Http\Controllers\Api;

use Kouloughli\Repositories\Country\CountryRepository;
use Kouloughli\Transformers\CountryTransformer;

/**
 * Class CountriesController
 * @package Kouloughli\Http\Controllers\Api
 */
class CountriesController extends ApiController
{
    /**
     * @var CountryRepository
     */
    private $countries;

    public function __construct(CountryRepository $countries)
    {
        $this->middleware('auth');
        $this->countries = $countries;
    }

    /**
     * Get list of all available countries.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithCollection(
            $this->countries->all(),
            new CountryTransformer
        );
    }
}
