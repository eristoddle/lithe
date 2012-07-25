<?=$this->form->create();?>
    <?=$this->form->field('title');?>
    <?=$this->form->field('body', array('type' => 'textarea'));?>
	<?=$this->form->field('tags');?>
	<?=$this->form->field('created', array('type' => 'hidden','value' => date('Y-m-d H:i:s', time())));?>
    <?=$this->form->submit('Add Post', array('class' => 'btn btn-inverse'));?>
<?=$this->form->end();?>