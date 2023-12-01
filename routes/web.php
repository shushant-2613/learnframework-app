<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AllPostsController;

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

//It is used to show all user posts
Route::get('/allposts', [AllPostsController::class, 'index'])->name('allposts.index');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

//Store route is used to store the data in database.
Route::post('/posts', [PostController::class, 'store']);


Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');


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
