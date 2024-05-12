<?php

namespace App\Http\Controllers;

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
        // $post = new Post();

        // $attributes = request()->validate([
        //     'title' => 'required',
        //     // 'thumbnail' => 'required|image',
        //     'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
        //     'slug' => ['required', Rule::unique('posts', 'slug')],
        //     'excerpt' => 'required',
        //     'body' => 'required',
        //     'category_id' => ['required', Rule::exists('categories', 'id')]
        // ]);

        // $attributes = $this->validatePost(new Post());
        // $attributes = $this->validatePost();

        // $attributes['user_id'] = auth()->id();
        // $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnail');

        $attributes = array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        Post::create($attributes);

        // Post::create(array_merge($this->validatePost(), [
        //     'user_id' => request()->user()->id,
        //     'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        // ]));

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }
    public function update(Post $post)
    {
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

    // public function validatePost(Post $post): array
    // public function validatePost(?Post $post = null): array
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
