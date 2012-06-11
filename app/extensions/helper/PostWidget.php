<?php

 /**
Description: Lithium Helper for Posts on sidebar
*/

namespace app\extensions\helper;

use app\models\Posts;

#TODO: Look this over for better ways to do things
#i.e. path is wired, manually pulling out post _ids, etc.
class PostWidget extends \lithium\template\Helper {

	function __recent_posts($limit=10) {
	
		$results = Posts::find('all',	array(
			'order' => array('created' => 'DESC'),
			'limit' => $limit
		));
		
		$posts = array();
		
		foreach($results as $p){
			$posts[(string)$p->_id] = $this->escape($p->title);
		}
		
		return $posts;
		
	}

	public function recent_posts_widget() {
	
		$r_posts = "";
		
		foreach ($this->__recent_posts(10) as $i => $p) {
			//$p = $this->escape($p);
			$r_posts .=  '<li><a href="/posts/view/'.$i.'">'.$p.'</a></li>';
			//$r_posts .= $p;
		}
		
		return $r_posts;
	
	}

}