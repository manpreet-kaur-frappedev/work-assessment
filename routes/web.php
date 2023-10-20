<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolesController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('login', [UserController::class, 'login'])->name('user.login');
Route::get('register', [UserController::class, 'register'])->name('user.register');
Route::post('createUser', [UserController::class, 'createUser'])->name('user.createUser');
Route::post('loginUser', [UserController::class, 'loginUser'])->name('user.loginUser');

Route::middleware(['auth'])->group(function () {
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
	Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');
	Route::resource('employee', EmployeeController::class);
	Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
	Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
	Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store');
	Route::get('/tasks/settings/{id}', [TaskController::class, 'settings'])->name('task.settings');
	Route::get('/tasks/status/{id}/{type}', [TaskController::class, 'status'])->name('task.status');
	Route::post('/tasks/saveSettings/{id}', [TaskController::class, 'saveSettings'])->name('task.saveSettings');
	Route::get('/notifications/clearAll', [NotificationController::class, 'clearAll'])->name('notification.clearAll');
	Route::resource('roles', RolesController::class);
	Route::get('/tasks/comments/{id}', [TaskController::class, 'comments'])->name('tasks.comments');
	Route::get('/tasks/uploadedFiles/{id}', [TaskController::class, 'uploadedFiles'])->name('tasks.uploadedFiles');
	Route::post('/notifications/applyNotification', [NotificationController::class, 'applyNotification'])->name('notifications.applyNotification');
	Route::post('/tasks/addComment/{id}', [TaskController::class, 'addComment'])->name('tasks.addComment');
	Route::post('/tasks/uploadFile/{id}', [TaskController::class, 'uploadFile'])->name('tasks.uploadFile');
	Route::post('/tasks/assignedTo/{id}', [TaskController::class, 'assignedTo'])->name('tasks.assignedTo');
});