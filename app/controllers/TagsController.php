<?php

namespace app\controllers;

use app\models\Posts;
use lithium\security\Auth;

class TagsController extends \lithium\action\Controller {

    public function index() {
        $result = Posts::find('all', array(
				'fields' => array('tags')
		));
		$tags = array();
		foreach($result as $t){
			$tags = array_merge($tags,$t->tags->to('array'));
		}
		$tags = array_unique($tags);
		return compact('tags');
    }
	
	public function view($tag=null) {
		if($tag){
			$posts = Posts::find('all', array(
				'conditions' => array('tags' => $tag)
			));
			return compact('posts');
		}
	}

}

?>