<?php

namespace app\models;

use lithium\util\collection\Filters;
use lithium\util\Inflector;
use lithium\security\Auth;

use ali3\storage\Session;

class Posts extends \lithium\data\Model {

    public $belongsTo = array('Users');
    
    protected $_user = null;
    
    public function user($record) {
        if (!empty($record->_user)) {
                return $record->_user;
        }
        $_user = Users::find($record->user_id);
        return $record->_user = $_user;
    }
    
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

/*Lazy loading tags, slugs, author id filter*/
Filters::apply('app\models\Posts', 'save', function($self, $params, $chain) {

    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }
	
	/* Tags */
    if (!empty($params['entity']->tags)) {
        $params['entity']->tags = explode(",",$params['entity']->tags);
    }
	
	/* Slug */	
	if (!($params['entity']->exists())) {
        $slug = Inflector::slug($params['entity']->title);
        $count = Posts::find('count', array(
			'fields' => array('id'),
			'conditions' => array('slug' => array('like' => '/^(?:' . $slug . ')(?:-?)(?:\d?)$/i')),
		));
        $params['data']['slug'] = $slug . ($count ? "-" . (++$count) : '');
    }
	
	/* User */
	$user = Auth::Check("default");
	$params['data']['user_id'] = $user['_id'];

    return $chain->next($self, $params, $chain);

});

?>