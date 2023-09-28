<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskDestroyTest extends TestCase
{
    use RefreshDatabase;


    public function test_destroy_task()
    {
        $newUser = User::create([
            'name' => 'destroy',
            'email' => 'destroy@gmail.com',
            'password' => 'password',
        ]);

        $newTask = $newUser->tasks()->create([
            'title' => 'destroy',
            'description' => 'destroy',
        ]);

        $token = auth()->login($newUser);
        $response = $this->withHeaders(['Authorization' => "Bearer $token"])->delete("api/delete/{$newTask->id}");
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Task Deleted Successfully.']);

        $this->assertDatabaseMissing('tasks', ['id' => $newTask->id]);

    }
}
