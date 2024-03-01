<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function(){
    return view('signup');
});
Route::get('/login', function(){
    return view('login');
});

Route::post('/signup', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout']);


Route::get('/dashboard', function(){
    return view('dashboard');
});

Route::get('/tasks', [TaskController::class, 'getAllTasks']);
Route::post('/task', [TaskController::class, 'create']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/task/{id}', [TaskController::class, 'delete']);


Route::get('/users', [UserController::class, 'showUsers']);
Route::delete('/user/{id}', [UserController::class, 'delete']);

Route::get('/task-dashboard', function(){
    return view('task-dashboard');
});
