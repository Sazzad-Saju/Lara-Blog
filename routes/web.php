<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Newsletter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/create', [PostController::class, 'create']);
Route::post('posts', [PostController::class, 'store']);
Route::get('posts/{post}/edit', [PostController::class, 'edit']);
Route::patch('posts/{post}', [PostController::class, 'update']);
Route::delete('posts/{post}', [PostController::class, 'destroy']);

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', NewsletterController::class);

//admin
// Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('can:admin');
// Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('can:admin');
// Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
// Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
// Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('can:admin');
// Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('can:admin');

Route::middleware('can:admin')->group(function(){
    Route::get('admin/posts/status={status}', [AdminPostController::class, 'updateAllStatus']);
    Route::resource('admin/posts', AdminPostController::class)->except('show');
    // Route::get('admin/posts', [AdminPostController::class, 'index']);
    // Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    // Route::post('admin/posts', [AdminPostController::class, 'store']);
    // Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});