<?php foreach($posts As $post): ?>
<item>
	<title><?= $post->title; ?></title>
	<description><?= $post->body; ?></description>
	<link><?= $this->html->link($post->title, array('Posts::show', 'id' => $post->id)); ?></link>
	<guid isPermaLink="true">http://lithe.dir23.com/<?= $post->id ?></guid>
	<pubDate><?= date('D, d M Y g:i:s O', $post->created->sec); ?></pubDate>
</item>
<?php endforeach; ?>