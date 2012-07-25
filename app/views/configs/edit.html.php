<?=$this->form->create(); ?>
    <?=$this->form->field('name',array( 
			'value' => $name, 
		));?>
    <?=$this->form->field('value',array( 
			'value' => $value, 
		));?>
    <?=$this->form->submit('Edit Config', array('class' => 'btn btn-inverse'));?>
<?=$this->form->end(); ?>