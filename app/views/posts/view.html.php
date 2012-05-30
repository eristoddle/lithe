<article>
	<h1><?=$post->title ?></h1>
	<p><?=$post->body ?></p>
	<p><?=$post->tags ?></p>
<article>
<div class="comments">
	<h2>Comments</h2>
	<?php if(isset($post->comment)): ?>
	   <?php foreach($post->comment as $comment): ?>
		<div class="comment">
		   <h3><?= $comment->title; ?></h3>
		   <p><?= $comment->contact; ?></p>
		   <p><?= $comment->body; ?></p>
		</div>
	   <?php endforeach; ?>
	<?php endif; ?>
</div>
<div class="commentform">
	<h2>Add a Comment</h2>
	<?=$this->form->create(null, array('action'=>'comment/'.$post->_id)); ?>
		<?=$this->form->field('title');?>
		<?=$this->form->field('contact');?>
		<?=$this->form->field('body', array('type' => 'textarea'));?>
		<?=$this->form->submit('Add Comment'); ?>
	<?=$this->form->end(); ?>
</div>