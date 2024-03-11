@extends('layout')

@section('content')
    <article>
        {{-- <?= $post; ?> --}}
        {{-- <h1><?= $post->title ?></h1> --}}
        <h1>{{ $post->title }}</h1>
        {{-- <div>
            <?= $post->body ?>
        </div>
        <div>{{ $post->body}}</div> --}}
        <div>{!! $post->body !!}</div>
    </article>
    <a href="/">Go Back</a>
@endsection

