<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            return response()->json(['message' => 'User Registered Successfully.'], 201);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }

    public function me()
    {
        $user = auth()->user();
        return response()->json(['user' => $user]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out.'
        ], 200);
    }


//    task
    public function store(Request $request)
    {
        $user = auth()->user();
        try {
            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $user->id,
                'status' => 'in-progress',
            ]);
            return response()->json(['message' => 'New Task Created Successfully.'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $request->validated();
        $user = auth()->user();
        try {
            $limitation = $user->limitation;
            $updatedAt = $user->updated_at;
            $currentDate = Carbon::now();
            if (!Gate::allows('update-task', $task)) {
                $user->limitation = 1;
                $user->updated_at = $currentDate;
                $user->save();
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            if ($request->has('title')) {
                $task->title = $request->title;
            } else if ($request->has('description')) {
                $task->description = $request->description;
            } else if ($request->has('status')) {
                $task->status = $request->status;
            }
            if (!$limitation) {
                $task->save();
                return response()->json(['message' => 'Task Updated Successfully.'], 200);
            } else {
                $DaysDifference = $updatedAt->diffInDays($currentDate);

                if ($DaysDifference > 1) {
                    $user->limitation = 0;
                    $user->save();
                    return response()->json(['message' => 'Your limit has been removed. Please try again'], 403);
                }

                return response()->json(['message' => 'You have been restricted for one day due to the violation'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function destroy(Request $request, Task $task)
    {
        $user = auth()->user();
        try {
            $limitation = $user->limitation;
            $updatedAt = $user->updated_at;
            $currentDate = Carbon::now();

            if (!Gate::allows('update-task', $task)) {
                $user->limitation = 1;
                $user->updated_at = $currentDate;
                $user->save();
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            if (!$limitation) {
                $task->delete();
                return response()->json(['message' => 'Task Deleted Successfully.'], 200);
            } else {
                $DaysDifference = $updatedAt->diffInDays($currentDate);

                if ($DaysDifference > 1) {
                    $user->limitation = 0;
                    $user->save();
                    return response()->json(['message' => 'Your limit has been removed. Please try again'], 403);
                }

                return response()->json(['message' => 'You have been restricted for one day due to the violation'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

}
