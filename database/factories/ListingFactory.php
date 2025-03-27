<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    public function definition(): array
    {
        /** @var User $user */
        $user = User::factory()->create();

        return [
            'user_id'      => $user->id,
            'title'        => $this->faker->sentence,
            'description'  => $this->faker->paragraph,
            'price'        => $this->faker->randomFloat(2, 1, 100),
            'phone'        => $this->faker->phoneNumber,
            'has_whatsapp' => $this->faker->boolean,
            'has_telegram' => $this->faker->boolean,
            'latitude'     => $this->faker->latitude,
            'longitude'    => $this->faker->longitude,
            'status'       => 'moderate',
            'expires_at'   => now()->addDays(30),
            'views'        => 0,
        ];
    }
}
