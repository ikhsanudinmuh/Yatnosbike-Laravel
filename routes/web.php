<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
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

#auth routes
Route::get('/login', [UserController::class, 'login'])->name('loginUser');
Route::post('/login', [UserController::class, 'loginPost'])->name('loginUserPost');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

#user routes
Route::get('/register', [UserController::class, 'index'])->name('registerUser');
Route::post('/register', [UserController::class, 'register'])->name('registerUserPost');

#product routes
Route::get('/', [ProductController::class, 'index'])->name('productIndex');
Route::get('/search', [ProductController::class, 'search'])->name('productSearch');
Route::get('/bicycle', [ProductController::class, 'indexBicycle'])->name('productIndexBicycle');
Route::get('/part', [ProductController::class, 'indexPart'])->name('productIndexPart');
Route::get('/accessories', [ProductController::class, 'indexAccessories'])->name('productIndexAccessories');
Route::get('/products', [ProductController::class, 'productManagement'])->name('productManagement');
Route::get('/products/{id}', [ProductController::class, 'detail'])->name('productDetail');
Route::post('/products/create', [ProductController::class, 'store'])->name('productCreate');
Route::put('/products/update/{id}', [ProductController::class, 'edit'])->name('productUpdate');
Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('productDelete');

#forum routes
Route::get('/forum', [ForumController::class, 'index']);
Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forumDetail');
Route::delete('/forum/{id}/delete/{forum_chat_id}', [ForumController::class, 'destroyForumChat'])->name('forumChatDelete');
Route::post('/forum/create', [ForumController::class, 'store'])->name('forumCreate');
Route::post('/forum/chat/{id}', [ForumController::class, 'storeForumChat'])->name('forumChat');
Route::delete('/forum/delete/{id}', [ForumController::class, 'destroy'])->name('forumDelete');

#transactions routes
Route::get('/transactions', [TransactionController::class, 'index']);
Route::get('/transactions/users/{id}', [TransactionController::class, 'show']);
Route::post('/transactions/{product_id}', [TransactionController::class, 'store'])->name('transactionCreate');
Route::put('/transactions/cancel/{id}', [TransactionController::class, 'cancel'])->name('transactionCancel');
Route::put('/transactions/process/{id}', [TransactionController::class, 'process'])->name('transactionProcess');
Route::put('/transactions/deliver/{id}', [TransactionController::class, 'deliver'])->name('transactionDeliver');
Route::put('/transactions/delivered/{id}', [TransactionController::class, 'delivered'])->name('transactionDelivered');
Route::put('/transactions/check/{id}/{product_id}', [TransactionController::class, 'check'])->name('transactionCheck');
Route::put('/transactions/rating/{id}/{product_id}', [TransactionController::class, 'rating'])->name('transactionRating');
Route::put('/transactions/{id}', [TransactionController::class, 'uploadPaymentProof'])->name('transactionUpload');
Route::delete('/transactions/delete/{id}', [TransactionController::class, 'destroy'])->name('transactionDelete');
