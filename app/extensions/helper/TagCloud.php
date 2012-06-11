<?php

 /**
Description: Lithium Helper for Tags on Sidebar
*/

namespace app\extensions\helper;

use app\models\Posts;

class TagCloud extends \lithium\template\Helper {

	function __gettags() {
		$result = Posts::find('all', array(
				'fields' => array('tags')
		));		
		$tags = array();		
		foreach($result as $t){
			$tags = array_merge($tags,$t->tags->to('array'));
		}
		return array_unique($tags);
	}

	public function cloud() {
		$r_tags = "";
		foreach ($this->__gettags() as $t) {
			$t = $this->escape($t);
			$r_tags .=  '<li><a href="/tags/view/'.$t.'">'.$t.'</a></li>';
		}
		
		return $r_tags;
	
	}

}