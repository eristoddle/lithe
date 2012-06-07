<?php
namespace app\models;
use lithium\security\Password;

class Users extends \lithium\data\Model {

    public $validates = array(
        'username' => array(
            array('notEmpty', 'message'=>'You must include a username.')
        ),
        'password' => array(
            array('notEmpty', 'message'=>'You must include a password.')
        ),
    );
	
	public $hasMany = array('Posts' => array(
	'key' => array('id' => 'post_id')
	));

}

#TODO: Does This Belong HERE
#TODO: A way not to copy and paste for save and edit
//We call the applyFilter() method OUTSIDE the class to create our new filter rules
Users::applyFilter('save', function($self, $params, $chain){
    
    $record = $params['entity'];
    
    if(!$record->id && !empty($record->password)){
        $record->password = Password::hash($record->password);
    }

    $params['entity'] = $record;

    return $chain->next($self, $params, $chain);
});

Users::applyFilter('edit', function($self, $params, $chain){
    
    $record = $params['entity'];
    
    if(!$record->id && !empty($record->password)){
        $record->password = Password::hash($record->password);
    }

    $params['entity'] = $record;

    return $chain->next($self, $params, $chain);
});

?>