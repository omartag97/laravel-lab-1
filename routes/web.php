<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
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

Route::prefix('users')->middleware('auth:sanctum')->group(function(){
    Route::get('/logout',              [UserController::class, 'logout'])->name('user.logout');
});
Route::get('/users/register',           [UserController::class, 'register'])->name('users.register');
Route::post('/users/register/store',    [UserController::class, 'store'])->name('users.store');
Route::get('/users/login',              [UserController::class, 'login'])->name('users.login');
Route::post('/users/handlelogin',       [UserController::class, 'handlelogin'])->name('users.handlelogin');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// redirect to github to sign up
Route::get('/auth/githup/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');


// callback to index page
Route::get('/auth/github', function () {
    $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'email' => $githubUser->email,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/posts');
    });




// redirect to google to sign up
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');


// callback to index page
Route::get('/auth/google', function () {
    $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'email' => $googleUser->email,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'github_token' => $googleUser->token,
            'github_refresh_token' => $googleUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect('/posts');
});


//--------------------------------- CRUD Posts ---------------------------------

// Route::get('/',                 [PostController::class ,'index'])->name('post.index');
// Route::get('/post/create',      [PostController::class ,'create'])->name('post.create');
// Route::post('/post/store',      [PostController::class ,'store'])->name('post.store');
// Route::get('/post/{id}',        [PostController::class ,'show'])->name('post.show');
// Route::get('/post/edit/{id}',   [PostController::class ,'edit'])->name('post.edit');
// Route::post('/post/update/{id}',[PostController::class ,'update'])->name('post.update');
// Route::get('/post/delete/{id}', [PostController::class ,'delete'])->name('post.delete');

//------------------------------CRUD Posts with Resource------------------------------

Route::get('/posts/archive', [PostController::class, 'archive'])->name('posts.archive');
Route::get('/posts/deleteOldPosts', [PostController::class, 'deleteOldPosts'])->name('posts.queue');
Route::get('/posts/restoreAll', [PostController::class, 'restoreAll'])->name('posts.restore.all');
Route::post('/postsP/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
Route::resource('posts', PostController::class)->middleware('auth');


//--------------------------------- Comment ---------------------------------

Route::get('/posts/comment/{id}',      [CommentController::class, 'comment'])->name('posts.comment');
Route::post('/posts/store-comment/{id}', [CommentController::class, 'storeComment'])->name('posts.storeComment');
