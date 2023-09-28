<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTaskOwnership
{
    public function handle(Request $request, Closure $next): Response
    {

        $taskId = $request->route('task');

        $task = Task::findOrFail($taskId);

        if (!$task || $task->user_id !== auth()->user()->id()) {
            return \response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
