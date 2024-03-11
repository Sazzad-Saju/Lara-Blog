<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
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
    // $posts = Post::all();
    
    // // ddd($posts);
    // // ddd($posts[0]);
    // // ddd($posts[0]->getPathname());
    // // ddd((string)$posts[0]);
    // // ddd($posts[0]->getContents());
    
    // // return array_map(function($file) {
    // //     return $file->getContents();
    // // }, $files);
    
    // // return array_map(fn($file) => $file->getContents(), $files);
    
    // return view('posts', [
    //     'posts' => $posts
    // ]); //return view
    
    // $document = YamlFrontMatter::parseFile(
    //     resource_path('posts/my-fourth-post.html')
    // );
    // // ddd($document);
    // // ddd($document->body());
    // ddd($document->matter('title'));
    
    // $files = File::files(resource_path("posts"));
    
    // $posts = array_map(function($file){
    //     $document = YamlFrontMatter::parseFile($file);
    //     return new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     );
    // }, $files);
    
    // $posts = collect($files)
    //     ->map(function($file){
    //         $document = YamlFrontMatter::parseFile($file);
            
    //         return new Post(
    //             $document->title,
    //             $document->excerpt,
    //             $document->date,
    //             $document->body(),
    //             $document->slug
    //         );
    //     });
    
    // $posts = collect(File::files(resource_path("posts")))
    //     ->map(fn($file) => YamlFrontMatter::parseFile(($file)))
    //     ->map(fn($document) => new Post(
    //             $document->title,
    //             $document->excerpt,
    //             $document->date,
    //             $document->body(),
    //             $document->slug
    //         ));
    
    // $posts = [];
    
    // foreach($files as $file){
    //     $document = YamlFrontMatter::parseFile($file);
    //     $posts[] = new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug,
    //     );
    // }
    
    // ddd($posts);
    // ddd($posts[0]->title);
    // ddd($posts[0]->body);
    
    // return view('posts', ['posts' => $posts]);
    return view('posts', ['posts' => Post::all()]);
});

Route::get('/posts/{post}', function($slug){
    /*
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
    */
    
    /** Find a post by it's slug and pass it to view */
    $post = Post::find($slug);
    return view('post', [
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