<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [UserController::class, "register"]);
Route::post('/login', [UserController::class, "login"]);
Route::post('/logout', [UserController::class, "logout"]);

//Blog post
//Route::post('/createPost', [PostController::class, 'createPost']);
//Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
//Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
//Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//TaskRelatedRoutes
Route::post('/create-task', [TaskController::class, 'createTask'])->name('create.task');
Route::put('/updateTaskStatus/{taskId}', [TaskController::class, 'updateTask']);
Route::get('/task_overview/{task}', [TaskController::class, 'showTaskOverview'])->name('task.overview');

