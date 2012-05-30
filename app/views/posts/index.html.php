
<? foreach($posts as $post): ?>
<article>
    <h2>
        <!--Use the id column to build a link to this post -->
        <a href="/posts/view/<?=$post->_id ?>/">
            <!--Use the title column to show the post title -->
            <?=$post->title ?>
        </a>
    </h2>
    <!--Use the body column to show the posts contents -->
    <p><?=$post->body ?></p>
</article>
<? endforeach; ?>