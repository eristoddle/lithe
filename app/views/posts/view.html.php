<article>			
	<h1><?=$post->title ?></h1>
	<hr/>
	<div class="post-body">
        <?=$this->markdown->display($post->body); ?>
	</div>
		<?php if(!empty($post->tags)): ?>
		<hr/>
		<div class="tags">
			<h4>Tags</h4>
				<?php foreach($post->tags as $tag): ?>
					<span class="label label-info"><?=$this->html->link($tag,'/tags/view/'.$tag) ?></span>
				<?php endforeach; ?>
		</div>
		<?php endif; ?>
<article>
<hr/>
<?=$this->html->link($post->_user->full_name,'/users/view/'.$post->_user->_id, array('rel'=>'author')) ?> | 
<a href="" class="btn btn-primary">Edit Post</a>
<hr/>
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
        <?=$this->form->field( 
            'post_slug', 
            array( 
                'type' => 'hidden', 
                'value' => $post->slug
            ) 
        );?>
		<?=$this->form->submit('Add Comment'); ?>
	<?=$this->form->end(); ?>
</div>
<?php
	/*Data Dump*/
	echo '<pre>';
	print_r($post->data());
	echo '</pre>';
?>