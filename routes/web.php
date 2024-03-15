<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
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
Route::get('/home_team/{teamId}', [App\Http\Controllers\HomeController::class, 'team'])->name('home_team');
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

//projects
Route::get('/project_dashboard/{project}', [ProjectController::class, 'showProjectDashboard'])->name('project_dashboard');
Route::post('/update-chosen-team', [ProjectController::class, 'updateChosenTeamCards'])->name('update-chosen-team');
Route::post('/update-button-project', [ProjectController::class, 'updateButtonProject'])->name('update-button-project');

//documentation
Route::post('/upload', [FileController::class, 'upload'])->name('upload');
Route::post('/download', [FileController::class, 'upload'])->name('download');
Route::get('/preview-pdf', [FileController::class, 'previewPdf'])->name('previewPdf');
Route::get('/open-documentation', [FileController::class, 'openDocumentation'])->name('open-documentation');


//admin
Route::get('/admin-page', [App\Http\Controllers\HomeController::class, 'admin_page'])->name('admin-page');
Route::delete('/admin/{userId}', [UserController::class, 'removeAdmin'])->name('removeAdmin');
Route::post('/add-new-admin', [UserController::class, 'addNewAdmin'])->name('add.new.admin');
Route::delete('/removeProject/{projectId}', [ProjectController::class, 'removeProject'])->name('removeProject');
Route::post('/add-new-project', [ProjectController::class, 'addNewProject'])->name('add.new.project');
Route::delete('/removeTeam/{teamId}', [TeamController::class, 'removeTeam'])->name('removeTeam');
Route::post('/add-new-team', [TeamController::class, 'addNewTeam'])->name('add.new.team');

//admining team
Route::post('/add-new-team-member', [TeamController::class, 'addNewTeamMember'])->name('add.team.member');






