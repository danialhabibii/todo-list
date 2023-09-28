<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLimitMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $todayTasksCount = \App\Models\Task::where('user_id', $user->id)->whereDate('created_at', \Carbon\Carbon::now()->toDateString())->count();

        if ($todayTasksCount >= 5) {
            $requestLimit = 3;

            if ($user->request_count >= $requestLimit) {
                return \response()->json(['message' => 'You have reached your request limit'], 403);
            }
            $user->task_created_at = Carbon::now();
            $user->request_count = $user->request_count + 1;
            $user->save();

        }

        return $next($request);
    }
}
