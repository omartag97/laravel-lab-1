<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', [CommentController::class])->middleware('auth:sanctum');


Route::get('/user/register',           [UserController::class ,'register'])->name('user.register');
Route::post('/user/register/store',    [UserController::class ,'store'])->name('user.store');
Route::get('/user/login',              [UserController::class ,'login'])->name('user.login');
Route::post('/user/handlelogin',       [UserController::class ,'handlelogin']);
Route::get('/user/logout',              [UserController::class ,'logout'])->name('user.logout');

