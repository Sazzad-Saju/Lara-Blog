<!doctype html>

<title>LaraBlog</title>
<link rel="stylesheet" href="/app.css">

<body>
    
    <?php foreach($posts as $post) : ?>
    <article>
        {{-- <?= $post; ?> --}}
        <a href="/posts/<?= $post->slug; ?>"><h1><?= $post->title; ?></h1></a>
        <div>
            {{-- <?= $post->body ?> --}}
            <?= $post->excerpt; ?>
        </div>
    </article>
    <?php endforeach; ?>
    
</body>

