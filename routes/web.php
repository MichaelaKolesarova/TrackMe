<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
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
Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
Route::post('/updatePicture', [UserController::class, 'updatePicture'])->name('updatePicture');
Route::delete('/deletePicture', [UserController::class, 'deletePicture'])->name('deletePicture');

Auth::routes();

//dashboards
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home_team', [App\Http\Controllers\HomeController::class, 'team'])->name('home_team');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');


//TaskRelatedRoutes
Route::post('/create-task', [TaskController::class, 'createTask'])->name('create.task');
Route::put('/updateTaskStatus/{taskId}', [TaskController::class, 'updateTask']);
Route::get('/task_overview/{task}', [TaskController::class, 'showTaskOverview'])->name('task.overview');
Route::post('/update-chosen-user', [TaskController::class, 'updateChosenUserCards'])->name('update-chosen-user');
Route::post('/update-button', [TaskController::class, 'updateButton'])->name('update-button');
Route::get('/deleteTask/{id}', [TaskController::class, 'deleteTask'])->name('deleteTask');

//update on obverview
Route::post('/updateOnlyStatus', [TaskController::class, 'updateTaskStatus'])->name('updateOnlyStatus');
Route::post('/updateOnlyPriority', [TaskController::class, 'updateTaskPriority'])->name('updateOnlyPriority');
Route::post('/updateOnlyAssignee', [TaskController::class, 'updateAssignee'])->name('updateOnlyAssignee');

//comments
Route::post('/create-comment', [CommentController::class, 'createComment'])->name('create.comment');
Route::get('/deleteComment/{id}', [CommentController::class, 'deleteComment'])->name('deleteComment');
Route::post('/editComment', [CommentController::class, 'editComment'])->name('editComment');

//messages
Route::get('/openChat/{userId}', [MessageController::class, 'openChat'])->name('openChat');
Route::get('/openTeamChat/', [MessageController::class, 'openTeamChat'])->name('openTeamChat');
Route::post('/create-message', [MessageController::class, 'createMessage'])->name('create.message');
Route::post('/receive', [MessageController::class, 'receive'])->name('receive');


Route::get('/deleteMessage/{id}', [MessageController::class, 'deleteMessage'])->name('deleteMessage');
Route::post('/editMessage', [MessageController::class, 'editMessage'])->name('editMessage');




