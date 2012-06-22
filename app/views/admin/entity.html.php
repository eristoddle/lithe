<?php
/**
 * Displays an edit/create form for an entity
 * 
 * TODO: iterate over each relationship and build links to each related entity
 * 
 * @property $entity
 * @property $fields
 */
?>

<?=$this->form->create( $entity );?>

<?php foreach( $fields as $field => $options ):?>

	<?=$this->form->field( $field, $options );?>

<?php endforeach;?>

	<?=$this->form->submit( 'Save' );?>

<?=$this->form->end();?>