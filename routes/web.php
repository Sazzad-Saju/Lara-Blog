<?php

use Illuminate\Support\Facades\Route;

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
    return view('posts'); //return view
});

Route::get('/posts/{post}', function($slug){
    
    
    if(!file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")){ //inline
        // ddd('File does not exist');
        // ddd('File does not exist');
        // abort(404);
        return redirect('/');
    }
    
    // $post = file_get_contents($path);
    
    // $post = cache()->remember("posts,{$slug}", 5, function() use($path){
    //     var_dump('file_get_contents');
    //    return file_get_contents(($path)); 
    // });
    
    //use arrow fn instead
    $post = cache()->remember("posts,{$slug}", 5, fn() => file_get_contents($path));
    
    return view('post',[
     'post' => $post
    ]); 
 })->where('post', '[A-z_\-]+');


// Route::get('/post', function(){
//    return view('post',[
//     'post' => "<h1>Hello World</h1>"     //keyvalue pair
//    ]); 
// });

// Route::get('/', function () {
//     return 'hello'; //return data
// });

// Route::get('/', function () {
//     return ['foo'=> 'bar']; //return json
// });