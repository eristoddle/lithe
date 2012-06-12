<?php

namespace app\models;

use lithium\util\collection\Filters;
use lithium\util\Inflector;

class Posts extends \lithium\data\Model {

    public $belongsTo = array('Users');

}

#TODO: Should filters be combined?

/*Lazy loading tags, slugs filter*/
Filters::apply('app\models\Posts', 'save', function($self, $params, $chain) {

    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }

    if (!empty($params['entity']->tags)) {
        $params['entity']->tags = explode(",",$params['entity']->tags);
    }
	
	if (!($params['entity']->exists())) {
        $slug = Inflector::slug($params['entity']->title);
        $count = Posts::find('count', array(
		'fields' => array('id'),
		'conditions' => array('slug' => array('like' => '/^(?:' . $slug . ')(?:-?)(?:\d?)$/i')),
		));
        $params['data']['slug'] = $slug . ($count ? "-" . (++$count) : '');
    }

    return $chain->next($self, $params, $chain);

});

?>