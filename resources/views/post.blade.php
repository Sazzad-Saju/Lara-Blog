<x-layout>
    <article>
        <h1>{{ $post->title }}</h1>
        {{-- <a href="/categories/{{$post->category->id}}">{{ $post->category->name }}</a> --}}
        <p>
            By <a href="/authors/{{$post->author->user_name}}">{{$post->author->name}}</a> in <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
        </p>
        <div>{!! $post->body !!}</div>
    </article>
    <a href="/">Go Back</a>
</x-layout>
