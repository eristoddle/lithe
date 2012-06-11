<?php

namespace app\models;

use lithium\util\collection\Filters;

class Posts extends \lithium\data\Model {

	public $belongsTo = array('Users');
	
}

/*Lazy loading tags filter*/
Filters::apply('app\models\Posts', 'save', function($self, $params, $chain) {

    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }
    
    if(!empty($params['entity']->tags)) {
        $params['entity']->tags = explode(",",$params['entity']->tags);
    }
    
    return $chain->next($self, $params, $chain);
	
});

#TODO: Blog post slugs
#http://blog.amalraghav.com/lithium-filters-a-practical-example/

?>