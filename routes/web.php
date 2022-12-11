<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';

Route::get('/todos/completed',[\App\Http\Controllers\TodoController::class,'getCompletedTodos']);
Route::get('/todos/incompleted',[\App\Http\Controllers\TodoController::class,'getIncompleteTodos']);
Route::get('/todo/{todo}',[\App\Http\Controllers\TodoController::class,'show']);

Route::post('/todos', [\App\Http\Controllers\TodoController::class, 'store']);
Route::patch('/todo/{todo}', [\App\Http\Controllers\TodoController::class,'update']);
Route::delete('/todo/{todo}',[\App\Http\Controllers\TodoController::class,'destroy']);
Route::post('/todo/{todo}/complete',[\App\Http\Controllers\TodoController::class,'setTodoAsComplete']);
Route::post('/todo/{todo}/incomplete',[\App\Http\Controllers\TodoController::class,'setTodoAsIncomplete']);
