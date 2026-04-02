<?php

//Rotas de API
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('projects', ProjectController::class);

Route::prefix('projects/{project}')->group(function () {
    Route::get('tasks', [TaskController::class, 'index']);          
    Route::post('tasks', [TaskController::class, 'store']);         
    Route::get('tasks/{task}', [TaskController::class, 'show']);    
    Route::put('tasks/{task}', [TaskController::class, 'update']);  
    Route::delete('tasks/{task}', [TaskController::class, 'destroy']); 
    Route::patch('tasks/{task}/status', [TaskController::class, 'updatedStatus']); 
});


Route::get('tags', [TagController::class, 'index']);   
Route::post('tags', [TagController::class, 'store']);  

Route::post('tasks/{task}/tags/{tag}', [TagController::class, 'attachToTask']);
Route::delete('tasks/{task}/tags/{tag}', [TagController::class, 'detachFromTask']);