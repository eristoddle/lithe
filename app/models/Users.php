<?php
namespace app\models;
use lithium\security\Password;
use lithium\util\Validator;

class Users extends \lithium\data\Model {

    public $validates = array(
        'username' => array(
            array('notEmpty', 'message'=>'You must include a username.')
        ),
        'password' => array(
            array('notEmpty', 'message'=>'You must include a password.')
        ),
//TODO: This breaks adding user when there is no email
/* 		'email' => array(
			array('notEmpty', 'message' => 'An Email Address for the user is required'),
			array('email', 'message' => 'A valid Email Address is required')
		)*/
    ); 
	
 	public static function __init(array $options = array()) {
        
		parent::__init($options);
		
		Validator::add('isUniqueUser', function ($value, $format, $options) {
				
			$conditions = array('username' => $value);
			
			if(isset($options["values"]["id"])) {
					$conditions[] = "id != " . $options["values"]["id"];
			}
			
			return !Users::find('first', array('conditions' => $conditions));
				
		});
	}
	
/* 	public static function passwordHash() {
	
	#http://www.jblotus.com/2011/08/27/understanding-filters-in-lithium-php/
	
	return static::_filter(__FUNCTION__, array(), function() {
		return 'foo';
    });
	
	} */
	
 	public function full_name($record) {
		return "{$record->firstname} {$record->lastname}";
    } 
	
	public $hasMany = array('Posts' => array(
	'key' => array('id' => 'post_id')
	));

}

/* Users::applyFilter('save', function($self, $params, $chain){
    
    $record = $params['entity'];
    
	if(!$record->id && !empty($record->password)){
        $record->password = Password::hash($record->password);
    }

    $params['entity'] = $record;

    return $chain->next($self, $params, $chain);
	
}); */

?>