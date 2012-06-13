<? foreach($posts as $post): ?>
<article>
    <h2>
        <?=$this->html->link($post->title,'/posts/'.$post->slug);?>
        </a>
    </h2>
    <p><?=$post->body; ?></p>
</article>
<? endforeach; ?>