<?php

namespace App\Http\Controllers;

use App\Enumeration\PostType;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {

        $attributes = array_merge($this->validatePost(), [
            // 'status' => PostType::$Approved,
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        Post::create($attributes);
        
        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }
    public function update(Post $post)
    {
        // ddd(request()->all());
        // $attributes = request()->validate([
        //     'title' => 'required',
        //     // 'thumbnail' => 'image',
        //     'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
        //     // 'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
        //     'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
        //     'excerpt' => 'required',
        //     'body' => 'required',
        //     'category_id' => ['required', Rule::exists('categories', 'id')]
        // ]);

        $attributes = $this->validatePost($post);

        // if(isset($attributes['thumbnail'])){
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
    
    public function updateAllStatus($status)
    {
        if($status == PostType::$Pending){
            Post::query()->update(['status' => PostType::$Pending]);
        }else if($status == PostType::$Approved){
            Post::query()->update(['status' => PostType::$Approved]);
        }else if($status == PostType::$Cancelled){
            Post::query()->update(['status' => PostType::$Cancelled]);
        }
        
        return back()->with('success', 'Status Updated!');
    }
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'status' => $post->exists ? ['required'] : PostType::$Approved,
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
