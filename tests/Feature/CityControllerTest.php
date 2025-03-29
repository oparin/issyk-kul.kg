<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\User;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    protected const ROUTE_PREFIX = 'api.v1.';

    public function test_index_returns_all_cities()
    {
        $user = User::factory()->create();

        // Create some cities
        City::factory()->count(5)->create();

        // Call the index method
        $response = $this->actingAs($user)->get(route(self::ROUTE_PREFIX . 'cities.index'));

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains all cities
        $response->assertJsonCount(5, 'data');
    }
}
