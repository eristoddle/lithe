<?php

namespace app\models;

class Posts extends \lithium\data\Model {

	public $belongsTo = array('Users' => array(
	'key' => '_id'
	));
}

?>