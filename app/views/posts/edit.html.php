<?=$this->form->create($post); ?>
    <?=$this->form->field('title');?>
    <?=$this->form->field('body', array('type' => 'textarea'));?>
	<?=$this->form->field('tags');?>
    <?=$this->form->submit('Edit Post', array('class' => 'btn btn-inverse')); ?>
<?=$this->form->end(); ?>