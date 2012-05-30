<?php if($saved): ?>
<h4>User <?=$data['username'] ?> created</h4>
<?php endif; ?>
<?=$this->form->create($user); ?>
    <?=$this->form->field('username'); ?>
    <?=$this->form->field('password',array('type'=>'password')); ?>
	<?=$this->form->field('website'); ?>
	<?=$this->form->field('email'); ?>
    <?=$this->form->submit('Add User', array('class' => 'btn btn-inverse'));?>
<?=$this->form->end(); ?>