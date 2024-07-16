<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    // use RefreshDatabase;

    public function test_registers_a_user_successfully(): void
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = 'password';

        $response = $this->postJson('/api/register', $user);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'username',
                'bio'
            ],
            'token',
        ]);


        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
        ]);
    }

    public function test_registeration_checks_if_required_fields_are_missing(): void
    {

        $user = User::factory()->make()->toArray();
        $user = collect($user)->only(['name'])->all();


        $response = $this->postJson('/api/register', $user);
        $response->assertStatus(422);
    }

    public function test_login_a_user_successfully(): void
    {
        $user = User::factory([
            'password' => Hash::make('123456')
        ])->create();

        $test_user['email'] = collect($user)->only('email')->all();
        // $test_user['email'] = $user->all()['email'];
        $test_user['password'] = "123456";

        $response = $this->postJson('/api/login', $test_user);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'username',
                'bio'
            ],
            'token',
        ]);
    }
}
