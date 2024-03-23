<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

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
    DB::listen(function($query){
        logger($query->sql, $query->bindings);
    });
    return view('posts', [
        'posts' => Post::latest()->get(),
        'categories' => Category::all(),
    ]);
})->name('home');

Route::get('posts/{post:slug}', function(Post $post){
    return view('post', ['post' => $post]);
});

Route::get('categories/{category:slug}', function(Category $category){
   return view('posts', [
    'posts' => $category->post,
    'currentCategory' => $category,
    'categories' => Category::all(),
    ]); 
});

Route::get('authors/{author:user_name}', function(User $author){
   return view('posts', [
    'posts' => $author->posts,
    'categories' => Category::all(),
   ]);
});