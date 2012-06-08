<?php
#TODO: Find where to implode tags
	//$post->tags = implode(",", (array)$post->tags);
	//var_dump($post['tags']);
?>
<?=$this->form->create($post); ?>
    <?=$this->form->field('title');?>
    <?=$this->form->field('body', array('type' => 'textarea'));?>
	<?=$this->form->field('tags');?>
    <?=$this->form->submit('Edit Post', array('class' => 'btn btn-inverse')); ?>
<?=$this->form->end(); ?>