<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

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
}
