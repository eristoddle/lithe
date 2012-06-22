<?=$this->form->create($config); ?>
    <?=$this->form->field('name');?>
    <?=$this->form->field('value');?>
    <?=$this->form->submit('Add Config', array('class' => 'btn btn-inverse'));?>
<?=$this->form->end(); ?>