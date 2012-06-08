<h4> Edit User: <?=$user['username'] ?></h4>
<?=$this->form->create($user); ?>
    <?//=$this->form->field('username'); ?>
    <?=$this->form->field('password',array('type'=>'password')); ?>
	<?=$this->form->field('website'); ?>
	<?=$this->form->field('email'); ?>
	<?=$this->form->field('first_name'); ?>
	<?=$this->form->field('last_name'); ?>
    <?=$this->form->submit('Edit User', array('class' => 'btn btn-inverse'));?>
<?=$this->form->end(); ?>