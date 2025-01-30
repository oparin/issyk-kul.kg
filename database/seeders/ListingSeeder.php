<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'John Doe',
            'email' => 'V4YD6@example.com',
            'password' => bcrypt('password'),
        ]);
        
        for ($i = 0; $i < 10000; $i++) {
            Listing::query()->create([
                'title' => 'Listing ' . $i,
                'description' => 'Description ' . $i,
                'price' => $i,
                'user_id' => $user->id,
                'expires_at' => Carbon::now()->addDays(30),
                'views' => $i
            ]);
        }
    }
}
