{{-- <x-layout content="Hello world">
    
</x-layout> --}}

{{-- <x-layout>
    <x-slot name="content">
        Hello World
    </x-slot>
</x-layout> --}}


<x-layout>
    @foreach($posts as $post)
        <article class="{{$loop->even ? 'color1' : 'color2'}}">
            <a href="/posts/{{$post->slug}}"><h1>{{$post->title}}</h1></a>
            <div>
                {{ $post->excerpt}}
            </div>
            <x-button>
                Read More
            </x-button>
        </article>
    @endforeach
</x-layout>

