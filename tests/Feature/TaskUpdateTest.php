<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{


//    public function testUpdate()
//    {
//        $user = User::create([
//            'name' => 'updateUser',
//            'email' => 'updateUser@gmail.com',
//            'password' => 'password'
//        ]);
//
//
//        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2OTU3OTU0MzgsImV4cCI6MTY5NTc5OTAzOCwibmJmIjoxNjk1Nzk1NDM4LCJqdGkiOiJhU2VjV3JJbzIxMUduVldtIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.2ApJo6fePgJgDra5gQcZDOOLBVNgIcpSymy3UVIJLGo";
//
//        $this->actingAs($user)->withHeaders(['Authorization' => "Bearer $token"]);
//        $task = Task::create([
//            'title' => 'Old Title',
//            'description' => 'Old Description',
//            'user_id' => $user->id,
//        ]);
//
//        $data = [
//            'title' => 'New Title',
//            'description' => 'New Description',
//        ];
//
//        $response = $this->post("api/update/{$task->id}", $data);
//        $response->assertStatus(200);
//
//        $response->assertJson(['message' => 'Task Updated Successfully.']);
//        $updatedTask = Task::find($task->id);
//        $this->assertEquals('Old Title',$task->title);
//        $this->assertEquals('Old Description',$task->description);
//
//    }
}
