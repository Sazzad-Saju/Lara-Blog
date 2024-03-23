<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::latest();
        // if(request('search')){
        //     $posts->where('title','like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%'. request('search') . '%')
        //         ->orWhere('excerpt', 'like', '%'. request('search') . '%');
        // }
        
        // dd(request('search')); //string
        // dd(request(['search'])); //array
        // dd(request()->only('search')); //array
        
        return view('posts', [
            // 'posts' => Post::latest()->filter()->get(),
            'posts' => Post::latest()->filter(request(['search']))->get(),
            'categories' => Category::all(),
        ]);
    }
    
    public function show(Post $post)
    {
        return view('post', ['post' => $post]);
    }
    
    public function getPosts(){
        // return Post::latest()->filter()->get();
        
        // $posts = Post::latest();
        // if(request('search')){
        //     $posts->where('title','like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%'. request('search') . '%')
        //         ->orWhere('excerpt', 'like', '%'. request('search') . '%');
        // }
        
        // return $posts->get();
    }
}
