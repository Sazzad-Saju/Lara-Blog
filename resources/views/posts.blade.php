{{-- <x-layout content="Hello world">
    
</x-layout> --}}

{{-- <x-layout>
    <x-slot name="content">
        Hello World
    </x-slot>
</x-layout> --}}


{{-- <x-layout>
    @foreach ($posts as $post)
        <article class="{{$loop->even ? 'color1' : 'color2'}}">
            <a href="/posts/{{$post->slug}}"><h1>{{$post->title}}</h1></a>
            <p>
                By <a href="/authors/{{$post->author->user_name}}">{{$post->author->name}}</a> in <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
            </p>
            <div>
                {{ $post->excerpt }}
            </div>
            <x-button>
                Read More
            </x-button>
        </article>
    @endforeach
</x-layout> --}}

<x-layout>
    @include('_posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count() > 0)
            {{-- reusable component  --}}
            <x-post-grid :posts="$posts" />
        @else
            <p class="text-center">No posts yet. Please check later!</p>
        @endif

        {{-- <div class="lg:grid lg:grid-cols-3">
            <x-post-card />
            <x-post-card />
            <x-post-card />
        </div> --}}
    </main>
</x-layout>
