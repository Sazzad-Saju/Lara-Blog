<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
// use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        // return Post::latest()->filter(
        //     request(['search', 'category', 'author'])
        // )->paginate(10);
        
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            // )->get(),
            // )->paginate(),
            // )->paginate(6),
            )->paginate(6)->withQueryString(),
            // )->simplePaginate(6),
        ]);
    }
    
    public function show(Post $post)
    {
        $post->load('author');
        return view('posts.show', ['post' => $post]);
    }
    
    public function create()
    {
        // if(auth()->guest()){
        //     // abort(403);
        //     abort(Response::HTTP_FORBIDDEN);
        // }
        
        // if(auth()->user()->user_name !== 'SuperAdmin'){
        //     abort(Response::HTTP_FORBIDDEN);
        // }
        // if(auth()->user()?->user_name !== 'SuperAdmin'){
        //     abort(Response::HTTP_FORBIDDEN);
        // }
        return view('posts.create');
    }
    
    public function store()
    {
        // request()->file('thumbnail')->store('thumbnails');
        // return 'Done';
        // // ddd(request()->all());
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
        
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnail');
        
        Post::create($attributes);
        
        return redirect('/');
    }
}
