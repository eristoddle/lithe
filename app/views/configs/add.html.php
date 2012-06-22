<?=$this->form->create($config); ?>
    <?=$this->form->field('name');?>
    <?=$this->form->submit('Add Config', array('class' => 'btn btn-inverse'));?>
<?=$this->form->end(); ?>
<?php
	/*Data Dump*/
	echo '<pre>';
	print_r($config->data());
    //print_r($name->data());
	echo '</pre>';
?>