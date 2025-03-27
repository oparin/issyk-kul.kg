<?php

namespace Tests\Feature;

use App\Http\API\Controllers\ListingController;
use App\Http\API\Services\ListingService;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected const ROUTE_PREFIX = 'api.v1.';

    private ListingController $listingController;
    private ListingService    $listingService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->listingService    = new ListingService();
        $this->listingController = new ListingController($this->listingService);
    }

    /**
     * @test
     */
    public function test_index_returns_all_listings()
    {
        $user = User::factory()->create();

        // Create some listings
        Listing::factory()->count(5)->create();

        // Call the index method
        $response = $this->actingAs($user)->getJson(route(self::ROUTE_PREFIX . 'listing.index'));

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains all listings
        $response->assertJsonCount(5, 'data');
    }

    /**
     * @test
     */
    public function test_store_creates_new_listing()
    {
        $user = User::factory()->create();

        $data = [
            'title'       => 'New Listing',
            'description' => 'This is a new listing',
            'price'       => 10.99,
        ];

        // Call the store method
        $response = $this->actingAs($user)
            ->withHeaders(['Accept' => 'application/json'])
            ->post(route(self::ROUTE_PREFIX . 'listing.store'), $data);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the new listing
        $response->assertJsonFragment([
            'title'       => 'New Listing',
            'description' => 'This is a new listing',
            'price'       => '10.99',
        ]);
    }

    /**
     * @test
     */
    public function test_show_returns_single_listing()
    {
        $user = User::factory()->create();

        // Create a new listing
        $listing = Listing::factory()->create();

        // Call the show method
        $response = $this->actingAs($user)->getJson(route(self::ROUTE_PREFIX . 'listing.show', $listing->id));

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the listing
        $response->assertJsonFragment([
            'id'          => $listing->id,
            'title'       => $listing->title,
            'description' => $listing->description,
            'price'       => (string)$listing->price,
        ]);
    }

    /**
     * @test
     */
    public function test_update_updates_existing_listing()
    {
        $user = User::factory()->create();

        // Create a new listing
        $listing = Listing::factory()->create();

        // Create an update request
        $data = [
            'title'       => 'Updated Listing',
            'description' => 'This is an updated listing',
            'price'       => 12.99,
        ];

        // Call the update method
        $response = $this->actingAs($user)->put(route(self::ROUTE_PREFIX . 'listing.update', $listing->id), $data);

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the response contains the updated listing
        $response->assertJsonFragment([
            'title'       => 'Updated Listing',
            'description' => 'This is an updated listing',
            'price'       => '12.99',
        ]);
    }

    public function test_destroy_deletes_listing()
    {
        $user = User::factory()->create();

        // Create a new listing
        $listing = Listing::factory()->create();

        // Call the destroy method
        $response = $this->actingAs($user)->delete(route(self::ROUTE_PREFIX . 'listing.destroy', $listing->id));

        // Assert the response is successful
        $response->assertSuccessful();

        // Assert the listing is deleted
        $this->assertSoftDeleted('listings', ['id' => $listing->id]);
    }
}
