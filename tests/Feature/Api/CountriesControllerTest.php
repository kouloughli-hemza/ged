<?php

namespace Tests\Feature\Http\Controllers\Api;

use Tests\Feature\ApiTestCase;
use Kouloughli\Country;
use Kouloughli\Transformers\CountryTransformer;

class CountriesControllerTest extends ApiTestCase
{
    /** @test */
    public function unauthenticated()
    {
        $this->getJson('/api/countries')->assertStatus(401);
    }

    /** @test */
    public function get_all_countries()
    {
        $this->login();

        $transformed = $this->transformCollection(
            Country::all(),
            new CountryTransformer
        );

        $this->getJson("/api/countries")
            ->assertOk()
            ->assertJson($transformed);
    }
}
