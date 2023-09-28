<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthLogoutTest extends TestCase
{


//    public function test_logout()
//    {
//        $user = new User([
//            'name' => 'logout',
//            'email' => 'logouts@gmail.com',
//            'password' => 'password'
//        ]);
//        $user->save();
//
//        $token = auth()->login($user);
//
//        $response = $this->withHeaders([
//            'Authorization' => 'Bearer '. $token,
//        ])->post('api/auth/logout');
//
//        $response->assertStatus(200);
//        $response->assertJson(['message' => 'Successfully logged out.']);
//    }
}
