<?php

//Rotas de API
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Rotas de autenticação (públicas)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::get('/user', function (Request $request) {
    return response()->json(['message' => 'Endpoint público para testes']);
});

Route::apiResource('projects', ProjectController::class);

Route::prefix('projects/{project}')->group(function () {
    Route::get('tasks', [TaskController::class, 'index']);          
    Route::post('tasks', [TaskController::class, 'store']);         
    Route::get('tasks/{task}', [TaskController::class, 'show']);    
    Route::put('tasks/{task}', [TaskController::class, 'update']);  
    Route::delete('tasks/{task}', [TaskController::class, 'destroy']); 
    Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus']); 
});

// Rotas de tags (sem autenticação)
Route::get('tags', [TagController::class, 'index']);   
Route::post('tags', [TagController::class, 'store']);  
Route::put('tags/{tag}', [TagController::class, 'update']);
Route::delete('tags/{tag}', [TagController::class, 'destroy']);
Route::get('tags/{tag}', [TagController::class, 'show']);  

Route::post('task-tags/attach/{task}/{tag}', [TagController::class, 'attachToTask']);   
Route::delete('task-tags/detach/{task}/{tag}', [TagController::class, 'detachFromTask']);

Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/{user}', [UserController::class, 'update']);
Route::delete('users/{user}', [UserController::class, 'destroy']);
Route::get('users/{user}/projects', [UserController::class, 'projects']);
Route::get('users/{user}/tasks', [UserController::class, 'tasks']);