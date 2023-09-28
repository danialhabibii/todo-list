<?php
#region {asset}
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

#endregion


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('/me', [UserController::class, 'me']);
    Route::post('/logout', [UserController::class, 'logout']);
});
Route::group(['middleware' => ['auth:api', 'limit'], 'prefix' => 'tasks'], function ($router) {
    Route::post('store', [UserController::class, 'store']);
});
Route::group(['middleware' => 'auth:api', 'prefix' => 'action'], function ($router) {
    Route::put('update/{task}', [UserController::class, 'update']);
    Route::delete('destroy/{task}', [UserController::class, 'destroy']);
});
