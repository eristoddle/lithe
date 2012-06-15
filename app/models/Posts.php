<?php

namespace app\models;

use lithium\util\collection\Filters;
use lithium\util\Inflector;
use lithium\security\Auth;

class Posts extends \lithium\data\Model {

    public $belongsTo = array('Users');
    
    protected $_user = null;
    
    public function user($record) {
        if (!empty($record->_user)) {
                return $record->_user;
        }
        $_user = Users::find($record->user_id);
        $_user->fullname = Users::fullName($_user);
        return $record->_user = $_user;
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

Filters::apply('app\models\Posts', 'save', function($self, $params, $chain) {

    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }

});

?>