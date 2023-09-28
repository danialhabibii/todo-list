<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthMeTest extends TestCase
{
    public function it_returns_authenticated_user()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->get('api/auth/me');

        $response->assertStatus(200);

        $response->assertJson(['user' => $user->toArray()]);
    }
}
