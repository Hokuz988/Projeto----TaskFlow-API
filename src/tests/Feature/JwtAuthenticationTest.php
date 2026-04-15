<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JwtAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_returns_a_bearer_token(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Ana',
            'email' => 'ana@example.com',
            'password' => 'secret123',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.email', 'ana@example.com')
            ->assertJsonPath('token_type', 'Bearer')
            ->assertJsonStructure([
                'data' => ['id', 'name', 'email'],
                'access_token',
                'token_type',
                'expires_in',
                'message',
            ]);
    }

    public function test_protected_route_requires_a_token(): void
    {
        $this->getJson('/api/auth/me')
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Token de autenticacao nao fornecido.',
            ]);
    }

    public function test_valid_token_allows_access_to_me_route(): void
    {
        $user = User::factory()->create([
            'password' => 'secret123',
        ]);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $token = $loginResponse->json('access_token');

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/auth/me')
            ->assertOk()
            ->assertJsonPath('data.id', $user->id)
            ->assertJsonPath('data.email', $user->email);
    }

    public function test_logout_blacklists_the_current_token(): void
    {
        $user = User::factory()->create([
            'password' => 'secret123',
        ]);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $token = $loginResponse->json('access_token');

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/auth/logout')
            ->assertOk()
            ->assertJson([
                'message' => 'Logout realizado com sucesso.',
            ]);

        $this->withHeader('Authorization', 'Bearer '.$token)
            ->getJson('/api/auth/me')
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Token revogado.',
            ]);
    }

    public function test_write_requests_must_be_json(): void
    {
        $this->post('/api/auth/login', [
            'email' => 'ana@example.com',
            'password' => 'secret123',
        ], [
            'Accept' => 'text/html',
        ])
            ->assertStatus(406)
            ->assertJson([
                'message' => 'Esta API aceita apenas requisicoes JSON.',
            ]);
    }
}