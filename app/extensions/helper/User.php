<?php

namespace app\extensions\helper;

use \lithium\storage\Session;

class User extends \lithium\template\Helper {
	
	public function session() {
		return Session::read('user', array('name' => 'username'));
	}
	
}