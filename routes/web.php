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

//dashboard
Route::get('/', [DashboardController::class, 'index'])->name('home');

//user
Route::resource('posts', PostController::class);

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

//auth
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

//feed
Route::post('newsletter', NewsletterController::class);

//admin
Route::middleware('can:admin')->group(function(){
    Route::get('admin/posts/status={status}', [AdminPostController::class, 'updateAllStatus']);
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});