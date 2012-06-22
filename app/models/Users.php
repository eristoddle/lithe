<?php

namespace app\models;

use lithium\security\Password;
use lithium\util\Validator;
use lithium\util\collection\Filters;

use ali3\storage\Session;

class Users extends \lithium\data\Model {

    public $validates = array(
        'username' => array(
            array('notEmpty', 'message' => 'You must include a username.'),
            array('isUniqueUser', 'message'=>'Username already taken'),
        ),
        'password' => array(
            array('notEmpty', 'message' => 'You must include a password.')
        ),
//TODO: This breaks adding user when there is no email
            /* 		'email' => array(
              array('notEmpty', 'message' => 'An Email Address for the user is required'),
              array('email', 'message' => 'A valid Email Address is required')
              ) */
    );

    public static function __init(array $options = array()) {

        parent::__init($options);

        Validator::add('isUniqueUser', function ($value, $format, $options) {

            $conditions = array('username' => $value);

            if (isset($options["values"]["id"])) {
                $conditions[] = "id != " . $options["values"]["id"];
            }

            return !Users::find('first', array('conditions' => $conditions));
            
        });
    }

    public $hasMany = array(
        'Posts' => array(
            'key' => array('id' => 'post_id')
        )
    );
    
    //TODO: Set flash messages from Validator
    function set_flash_message($message){
   
        if(is_array($message)){
            $display = '<ul>';
            foreach($message as $key=>$val){
                foreach($val as $entry){
                    $display.='<li>'.$entry.'</li>';
                } 
            }
            $display.='</ul>';
        }
        else {
            $display = $message;
        }
        Session::write('Auth.message', $display);
    }


}

/* Lazy loading password and fullname filter */
Filters::apply('app\models\Users', 'save', function($self, $params, $chain) {

    $salt = Password::salt('bf', 6);

    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }

    if (!empty($params['entity']->password)) {
        $params['entity']->password = Password::hash($params['entity']->password, $salt);
    }
    
    if (empty($params['entity']->full_name)) {
        $params['entity']->full_name = $params['entity']->first_name." ".$params['entity']->last_name;
    }

    return $chain->next($self, $params, $chain);
    
});