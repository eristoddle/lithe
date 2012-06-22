<?php
/**
 * Displays list of links that will take the user to the records route for that model.
 * 
 * @property $models
 */
?>
<ul>
<?php foreach( $models as $model => $model_slug ):?>
	<li><?=$this->html->link( $model, array( 'Admin::records' ) + compact( 'model_slug' ) );?></li>
<?php endforeach;?>
</ul>