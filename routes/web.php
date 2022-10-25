<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
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




//--------------------------------- CRUD Users---------------------------------


Route::get('/user/register',           [UserController::class ,'register'])->name('user.register');
Route::post('/user/register/store',    [UserController::class ,'store'])->name('user.store');
Route::get('/user/login',              [UserController::class ,'login'])->name('user.login');
Route::get('/user/logout',              [UserController::class ,'logout'])->name('user.logout');
Route::post('/user/handlelogin',       [UserController::class ,'handlelogin'])->name('user.handlelogin');


//--------------------------------- CRUD Posts ---------------------------------

// Route::get('/',                 [PostController::class ,'index'])->name('post.index');
// Route::get('/post/create',      [PostController::class ,'create'])->name('post.create');
// Route::post('/post/store',      [PostController::class ,'store'])->name('post.store');
// Route::get('/post/{id}',        [PostController::class ,'show'])->name('post.show');
// Route::get('/post/edit/{id}',   [PostController::class ,'edit'])->name('post.edit');
// Route::post('/post/update/{id}',[PostController::class ,'update'])->name('post.update');
// Route::get('/post/delete/{id}', [PostController::class ,'delete'])->name('post.delete');

//------------------------------CRUD Posts with Resource------------------------------
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/archive', [PostController::class, 'archive'])->name('post.archive');
Route::get('/post/deleteOldPosts', [PostController::class, 'deleteOldPosts'])->name('post.queue');
Route::get('/post/restoreAll', [PostController::class, 'restoreAll'])->name('post.restore.all');
Route::post('/post/restore/{id}', [PostController::class, 'restore'])->name('post.restore');
Route::resource('post', PostController::class)->middleware('auth');


//--------------------------------- Comment ---------------------------------

Route::get('/post/comment/{id}',      [CommentController::class, 'comment'])->name('post.comment');
Route::post('/post/store-comment/{id}', [CommentController::class, 'storeComment'])->name('post.storeComment');




