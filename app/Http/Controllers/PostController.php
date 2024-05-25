<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
// use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        // dd(Gate::allows('admin'));
        // dd(request()->user()->can('admin'));
        // dd(request()->user()->cannot('admin'));
        // $this->authorize('admin');
        
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
