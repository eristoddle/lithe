<?php if($tags): ?>
	<article>
		<div class="tags">
		<h2>Tags</h2>
		<?php foreach($tags as $tag): ?>
			<span class="label label-info"><?=$this->html->link($tag,'/tags/view/'.$tag); ?></span>
	   <?php endforeach; ?>
		</div>
	</article>
<?php endif; ?>