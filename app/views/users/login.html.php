<?php if ($noauth): ?>
<h4>Login failed</h4>
<?php endif; ?>
<?=$this->form->create(); ?>
    <?=$this->form->field('username');?>
    <?=$this->form->field('password', array('type'=>'password'));?>
    <?=$this->form->submit('Login');?>
<?=$this->form->end();?>