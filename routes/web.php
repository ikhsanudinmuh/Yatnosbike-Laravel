<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
    return view('index');
});

#auth routes
Route::get('login', [AuthController::class, 'loginUser'])->name('loginUser');
Route::post('login', [AuthController::class, 'loginUserPost'])->name('loginUserPost');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

#user routes
Route::get('register', [UserController::class, 'index'])->name('registerUser');
Route::post('register', [UserController::class, 'register'])->name('registerUserPost');
