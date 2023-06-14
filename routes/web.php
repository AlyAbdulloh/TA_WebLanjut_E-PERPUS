<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNewController;
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
    return view('auth.login');
});

//route admin
Route::resource('admin', AdminController::class)->middleware('admin');


Route::get('/user', [UserNewController::class, 'showUser'])->middleware('admin');;
Route::resource('books', BookController::class)->middleware('admin');
Route::resource('comments', CommentController::class)->middleware('admin');
Route::resource('users', UserController::class)->middleware('admin');
Route::get('/dashboard', [UserController::class, 'showDashboard'])->middleware('admin');
Route::resource('transactions', TransactionController::class)->middleware('admin');

//route user
Route::get('/awal', function () {
    return view('layouts.user.main');
});

//login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

//register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
