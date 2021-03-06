<?=$this->form->create($user); ?>
<h4> Edit User: <?=$user['username']; ?></h4>
    <?=$this->form->field('username'); ?>
    <?=$this->form->field('password',array('type'=>'password')); ?>
    <?=$this->form->field('access', array(
        'type' => 'select',
        'list' => array(
            'default' => 'default',
            'admin' => 'admin',
            'editor' => 'editor',
            'contributor' => 'contributor',
        )
    )); ?>
    <?=$this->form->field('active', array(
        'type' => 'select',
        'list' => array(
            'active' => 'active',
            'inactive' => 'inactive',
        )
    )); ?>
	<?=$this->form->field('website'); ?>
	<?=$this->form->field('email'); ?>
	<?=$this->form->field('first_name'); ?>
	<?=$this->form->field('last_name'); ?>
    <?=$this->form->submit('Add User', array(
        'class' => 'btn btn-inverse'
    ));?>
<?=$this->form->end(); ?>