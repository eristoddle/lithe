<?php

namespace app\models;

class Posts extends \lithium\data\Model {

	public $belongsTo = array('Users');
	
	#TODO: Should there be an instance method for tags and comments here?
	
}

?>