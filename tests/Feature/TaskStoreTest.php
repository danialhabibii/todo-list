<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskStoreTest extends TestCase
{
//    public function test_store_new_task()
//    {
//        $user = new User([
//            'name' => 'StoreUser',
//            'email' => 'storeUser@gmail.com',
//            'password' => 'password',
//        ]);
//        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2OTU3OTU0MzgsImV4cCI6MTY5NTc5OTAzOCwibmJmIjoxNjk1Nzk1NDM4LCJqdGkiOiJhU2VjV3JJbzIxMUduVldtIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.2ApJo6fePgJgDra5gQcZDOOLBVNgIcpSymy3UVIJLGo";
//
//        $data = [
//            'title' => 'This is a test task',
//            'description' => 'This is a test task',
//        ];
//        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->post('api/tasks/store', $data);
////        $response = $this->post('api/tasks/store', $data);
//        $response->assertStatus(200);
//    }
}
