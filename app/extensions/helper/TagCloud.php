<?php

 /**
Description: Lithium Helper for Tags on Sidebar
*/

#TODO: Is TagCloud the best name for this Helper?

namespace app\extensions\helper;

use app\models\Posts;

class TagCloud extends \lithium\template\Helper {

	function __alltags() {
		#TODO: Better way to get unique list through MongoDB query?
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
		foreach ($this->__alltags() as $t) {
			$t = $this->escape($t);
			$r_tags .=  '<li><a href="/tags/view/'.$t.'">'.$t.'</a></li>';
		}
		
		return $r_tags;
	
	}
	
	public function tags_to_string($tags) {
		$html = "";
		$count = 0;
		foreach( $tags as $tag ){
			if( $count==0 ){
				$count++;
				$html = $tag;
				continue;
			}
			$html .= "," . trim( $tag );

		}
		return $html;
	}

}