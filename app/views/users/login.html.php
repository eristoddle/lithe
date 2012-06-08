<?=$this->form->create(); ?>
    <?=$this->form->field('username');?>
    <?=$this->form->field('password', array('type'=>'password'));?>
    <?=$this->form->submit('Login');?>
<?=$this->form->end();?>