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
    // $posts = Post::all();
    // ddd($posts);
    // return view('posts', ['posts' => $posts]);
    DB::listen(function($query){
        logger($query->sql, $query->bindings);
    });
    return view('posts', [
        // 'posts' => Post::all()
        // 'posts' => Post::latest()->with('category', 'author')->get()
        'posts' => Post::latest()->get()
    ]);
});

// Route::get('/posts/{post}', function($slug){
// Route::get('/posts/{id}', function($id){
// Route::get('posts/{post}', function(Post $post){
//    return view('post', ['post' => $post]);
// });

// Route::get('posts/{post:slug}', function(Post $post){
//     return view('post', ['post' => $post]);
// }); 
Route::get('posts/{post:slug}', function(Post $post){
    return view('post', ['post' => $post]);
});

// Route::get('posts/{post}', function(Post $post){
//     return $post;
//     /*
//     if(!file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")){ //inline
//         // ddd('File does not exist');
//         // ddd('File does not exist');
//         // abort(404);
//         return redirect('/');
//     }
    
//     // $post = file_get_contents($path);
    
//     // $post = cache()->remember("posts,{$slug}", 5, function() use($path){
//     //     var_dump('file_get_contents');
//     //    return file_get_contents(($path)); 
//     // });
    
//     //use arrow fn instead
//     $post = cache()->remember("posts,{$slug}", 5, fn() => file_get_contents($path));
    
//     return view('post',[
//      'post' => $post
//     ]); 
//     */
//     // ddd('what');
//     /** Find a post by it's slug and pass it to view */
//     // $post = Post::findOrFail($slug);
//     // $post = Post::findOrFail($id);
//     return view('post', [
//         'post' => $post
//     ]);
//  })->where('post', '[A-z_\-]+');


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

Route::get('categories/{category:slug}', function(Category $category){
   return view('posts', [
    // 'posts' => $category->post->load(['category', 'author'])
    'posts' => $category->post
    ]); 
});

// Route::get('authors/{author}', function(User $author){
Route::get('authors/{author:user_name}', function(User $author){
   return view('posts', [
    'posts' => $author->posts
   ]);
});
/** external */

Route::get('write-file', function(){
   $path = resource_path("posts/file.txt");
   $content = "This is test content";
   File::put($path, $content);
   
   if(File::exists($path)){
    echo "The file exists";
   }else{
    echo "Failed to create the file";
   }
});

Route::get('read-file', function(){
    $path = resource_path("posts/file.txt");
    if(File::exists($path)) {
        echo File::get($path);
    }
});

Route::get('collect', function(){
    // $collection = collect(['taylor', 'abigail', null])->map(function (?string $name) {
    //     return strtoupper($name);
    // })->reject(function (string $name) {
    //     return empty($name);
    // });
    $collection = collect(['taylor', 'abigail', null])
                ->map(fn($name) => strtoupper($name))
                ->reject(fn($name) => empty($name));
    
    // ddd($collection);
    
    // $collection2 = collect([1, 2, 3]);
    // ddd($collection2);
    
    Collection::macro('toLocale', function (string $locale) {
        return $this->map(function (string $value) use ($locale) {
            return Lang::get($value, [], $locale);
        });
    });
     
    $collection = collect(['first', 'second']);
     
    $translated = $collection->toLocale('es');
    ddd($translated);
});