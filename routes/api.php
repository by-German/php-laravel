<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});

/**
 * Laravel generates automatically 7 routes for Restful API actions
 * `index, create, store, show, edit, update, destroy`.
 * 
 * NOTE: The following code is equivalent to the previous one.
 * 
 * However, there are actions that are not necessary for the API, such as `create` and `edit`.
 * For this reason, it is recommended to use 
 * ->except(['create', 'edit']) 
 * to exclude them in order to avoid errors.
 *  
 */
Route::resource('tasks', TaskController::class)->except(['create', 'edit']);

Route::resource('students', StudentController::class)->except(['create', 'edit']);
