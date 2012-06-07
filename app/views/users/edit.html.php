<?php if($saved): ?>
<h4>User <?=$user['username'] ?> edited</h4>
<?php endif; ?>
<h4> Edit User: <?=$user['username'] ?></h4>
<?=$this->form->create($user); ?>
    <?//=$this->form->field('username'); ?>
    <?=$this->form->field('password',array('type'=>'password')); ?>
	<?=$this->form->field('website'); ?>
	<?=$this->form->field('email'); ?>
    <?=$this->form->submit('Edit User', array('class' => 'btn btn-inverse'));?>
<?=$this->form->end(); ?>