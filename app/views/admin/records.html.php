<?php
/**
 * Displays a DataTable with all of the records
 * 
 * TODO for any foreign key field, provide a link to the related entity's edit page
 * 
 * @property $records
 */

?>
<table>
	<thead>
		<tr>
<?php foreach( $fields as $field ):?>
			<th>
				<?=$field;?>
			</th>
<?php endforeach;?>
		</tr>
	</thead>
	<tbody>
<?php foreach( $records as $record ):?>
		<tr>
<?php     foreach( $fields as $field ):?>
			<td>
<?php         if( $field == $key ):?>
				<?=$this->html->link( $record->$field, array( 'Admin::entity', 'model_slug' => $this->_request->model_slug, 'id' => $record->$field ) );?>
<?php         elseif( isset( $foreign_keys[$field] ) ):?>
				<?=$this->html->link( $record->$field, array( 'Admin::entity', 'model_slug' => $foreign_keys[$field], 'id' => $record->$field ) );?>
<?php         else:?>			
				<?=$record->$field;?>
<?php         endif;?>
			</td>
<?php     endforeach;?>
		</tr>
<?php endforeach;?>
	</tbody>
</table>