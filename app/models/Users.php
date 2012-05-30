<?php

namespace app\models;
use lithium\security\Password;

class Users extends \lithium\data\Model {

    //Basic validation
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
//We call the applyFilter() method OUTSIDE the class to create our new filter rules
Users::applyFilter('save', function($self, $params, $chain){
    
    //Temporarily store our entity object so that we can manipulate it
    $record = $params['entity'];
    
    //If an id doesn't exist yet, then we know we're saving for the first time. If a 
    //password is provided, we need to hash it
    if(!$record->id && !empty($record->password)){
        $record->password = Password::hash($record->password);
    }

    //Write the modified object back to $params
    $params['entity'] = $record;

    //Allow the next filter to be run
    return $chain->next($self, $params, $chain);
});

?>