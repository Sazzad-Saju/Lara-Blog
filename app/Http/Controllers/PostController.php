<?php

namespace App\Http\Controllers;

use App\Enumeration\PostType;
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
        // dd(request()->user()->id);
        return view('posts.index',[
            'posts' => Post::where('user_id', request()->user()->id)->paginate(50)
        ]);
    }
    
    public function show(Post $post)
    {
        $post->load('author');
        return view('posts.show', ['post' => $post]);
    }
    
    public function create(){
        return view('posts.create');
    }
    
    public function store(Request $request){
        $attributes = array_merge($this->validatePost(), [
            'status' => PostType::$Pending,
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        Post::create($attributes);
        
        return redirect('/');
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }
    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);
        
        if($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post Deleted!');
    }
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
    
}
