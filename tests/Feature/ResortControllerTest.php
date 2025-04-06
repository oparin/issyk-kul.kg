<?php

namespace Tests\Feature;

use App\Models\Resort;
use App\Models\User;
use Tests\TestCase;

class ResortControllerTest extends TestCase
{
    protected const ROUTE_PREFIX = 'api.v1.';

    public function test_index_returns_all_resorts()
    {
        $user = User::factory()->create();

        // Create some resorts
        Resort::factory()->count(5)->create();

        // Call the index method
        $response = $this->actingAs($user)->get(route(self::ROUTE_PREFIX . 'resorts.index'));

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains all resorts
        $response->assertJsonCount(5, 'data');
    }
}
