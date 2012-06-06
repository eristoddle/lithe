<?php if($tags): ?>
	<article>
		<div class="tags">
		<h2>Tags</h2>
		<?php foreach($tags as $tag): ?>
			<span class="label label-info"><?=$this->html->link($tag,'/posts/tags/'.$tag) ?></span>
	   <?php endforeach; ?>
		</div>
	</article>
<?php endif; ?>
<?php if($posts): ?>
	<? foreach($posts as $post): ?>
	<article>
		<h2>
			<?=$this->html->link($post->title,'/posts/view/'.$post->_id) ?>
		</h2>
		<p><?=$post->body ?></p>
	</article>
	<? endforeach; ?>
<?php endif; ?>