<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    
    protected const LOGIN_ROUTE = '/api/v1/auth/login';
    
    public function test_login_successful()
    {
        $user = User::factory()->create([
            'email'    => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
        
        $data = [
            'email'    => 'test@example.com',
            'password' => 'password123',
        ];
        
        $response = $this->postJson(self::LOGIN_ROUTE, $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => ['token'],
            ]);
    }
    
    public function test_login_fails_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email'    => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
        
        $data = [
            'email'    => 'test@example.com',
            'password' => 'wrongpassword',
        ];
        
        $response = $this->postJson(self::LOGIN_ROUTE, $data);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'The provided credentials are incorrect.',
                'errors' => null,
            ]);
    }
    
    public function test_login_fails_with_validation_error()
    {
        $data = [
            'password' => 'password123',
        ];
        
        $response = $this->postJson(self::LOGIN_ROUTE, $data);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['email'],
            ]);
    }
}