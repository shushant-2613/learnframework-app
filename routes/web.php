<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AllPostsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserProfileController;


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');


//It is used to show all user posts
Route::get('/allposts', [AllPostsController::class, 'index'])->name('allposts.index');

Route::get('/comments/create/{postid}', [CommentController::class, 'create'])->name('comments.create');

//Route::post('/comments/store/{postid}', [CommentController::class, 'store'])->name('comments.store');

Route::get('/comments/{id}', [CommentController::class, 'index'])->name('comments.index');

Route::post('/comments', [CommentController::class, 'store']);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

Route::post('/posts', [PostController::class, 'store']);

Route::get('/send/{email}', [HomeController::class, "sendnotification"]);

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

Route::get('/userprofile', [UserProfileController::class, 'index'])->name('userprofile.index');


Route::get('/home', [HomeController::class, 'index']);

Route::get('/homePage/{name?}', function($name = null){ 
    return view('homePage', ['name' => $name]);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
