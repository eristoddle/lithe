<?=$this->form->create(); ?>
    <?=$this->form->field('title');?>
    <?=$this->form->field('body', array('type' => 'textarea'));?>
	<?=$this->form->field('tags');?>
    <?=$this->form->submit('Add Post', array('class' => 'btn btn-inverse')); ?>
<?=$this->form->end(); ?>

<? if ($success): ?>
    <p>Post Successfully Saved</p>
<? endif; ?>