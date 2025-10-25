<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SantumTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBeRetrieved(): void
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-user']
        );

        $response = $this->get('/api/user');

        $response->assertOk();
    }

    public function testUserCannotBeRetrievedWithoutToken(): void
    {
        $response = $this->withHeader('Accept', 'application/json')
        ->get('/api/user');

        $response->assertUnauthorized();
    }

    public function testLoginReturnsToken(): void
    {
        $user = User::factory()->create();

        $response = $this->withHeader('Accept', 'application/json')
        ->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
            'token',
        ]);
    }
}
