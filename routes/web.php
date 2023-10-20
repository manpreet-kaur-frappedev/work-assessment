<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
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

Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('register', [AuthController::class, 'registerAdmin'])->name('auth.register.admin');
Route::get('register/employee', [AuthController::class, 'registerEmployee'])->name('auth.register.employee');
Route::post('create-admin', [AuthController::class, 'createAdmin'])->name('auth.createAdmin');
Route::post('create-employee', [AuthController::class, 'createEmployee'])->name('auth.createEmployee');
Route::post('login-user', [AuthController::class, 'loginUser'])->name('auth.loginUser');

Route::middleware(['auth'])->group(function () {
	Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
	Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');
	Route::resource('users', UserController::class);
	Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
	Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
	Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store');
	Route::get('/tasks/settings/{id}', [TaskController::class, 'settings'])->name('task.settings');
	Route::get('/tasks/status/{id}/{type}', [TaskController::class, 'status'])->name('task.status');
	Route::post('/tasks/save-settings/{id}', [TaskController::class, 'saveSettings'])->name('task.saveSettings');
	Route::get('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notification.clearAll');
	Route::resource('roles', RolesController::class);
	Route::get('/tasks/comments/{id}', [TaskController::class, 'comments'])->name('tasks.comments');
	Route::get('/tasks/uploaded-files/{id}', [TaskController::class, 'uploadedFiles'])->name('tasks.uploadedFiles');
	Route::post('/notifications/apply-notification', [NotificationController::class, 'applyNotification'])->name('notifications.applyNotification');
	Route::post('/tasks/add-comment/{id}', [TaskController::class, 'addComment'])->name('tasks.addComment');
	Route::post('/tasks/upload-file/{id}', [TaskController::class, 'uploadFile'])->name('tasks.uploadFile');
	Route::post('/tasks/assigned-to', [TaskController::class, 'assignedTo'])->name('tasks.assignedTo');
});