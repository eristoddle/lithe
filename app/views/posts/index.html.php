
<? foreach($posts as $post): ?>
<article>
    <h2>
        <?=$this->html->link($post->title,'/posts/view/'.$post->_id) ?>
        </a>
    </h2>
    <p><?=$post->body ?></p>
</article>
<? endforeach; ?>