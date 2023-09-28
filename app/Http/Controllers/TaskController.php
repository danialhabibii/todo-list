<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use const http\Client\Curl\AUTH_ANY;

class TaskController extends Controller
{


//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['store','update','destroy']]);
//    }

    public function store(Request $request)
    {
        $user = auth()->user();
        try {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $user->id,
            ]);
            return response()->json(['message' => 'New Task Created Successfully.'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function update(Request $request, Task $task)
    {
        $user = auth()->user();
        try {
            if ($request->has('title')) {
                $task->title = $request->title;
            } else if ($request->has('description')) {
                $task->description = $request->description;
            }
            $task->save();
            return response()->json(['message' => 'Task Updated Successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function destroy(Request $request, Task $task)
    {
        try {
            $task->delete();
            return response()->json(['message' => 'Task Deleted Successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
