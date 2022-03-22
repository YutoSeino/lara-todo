<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

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
    return view('static_page');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('redirects',[LoginController::class, 'redirectTo'])->name('re');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');

    Route::get('/tasks/{id}', [TaskController::class, 'store'])->name('task.store');
    Route::post('/task/create', [TaskController::class, 'create'])->name('task.create');
});