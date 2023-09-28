<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskLimitMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $todayTasksCount = \App\Models\Task::where('user_id', $user->id)->whereDate('created_at', \Carbon\Carbon::now()->toDateString())->count();

        if ($todayTasksCount >= 5) {
            return response()->json(['message' => 'You have reached your daily task limit. Please try again tomorrow.'], 403);
        }

        return $next($request);
    }
}
