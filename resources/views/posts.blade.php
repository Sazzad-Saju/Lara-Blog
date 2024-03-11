<!doctype html>

<title>LaraBlog</title>
<link rel="stylesheet" href="/app.css">

<body>
    
    {{-- <?php foreach($posts as $post) : ?> --}}
    @foreach($posts as $post)
        {{-- @dd($post) --}}
        <article class="{{$loop->even ? 'color1' : 'color2'}}">
        {{-- <article> --}}
            {{-- <?= $post; ?> --}}
            {{-- <a href="/posts/<?= $post->slug; ?>"><h1><?= $post->title; ?></h1></a> --}}
            <a href="/posts/{{$post->slug}}"><h1>{{$post->title}}</h1></a>
            <div>
                {{-- <?= $post->body ?> --}}
                {{-- <?= $post->excerpt; ?> --}}
                {{ $post->excerpt}}
            </div>
        </article>
    {{-- <?php endforeach; ?> --}}
    @endforeach
    
</body>

