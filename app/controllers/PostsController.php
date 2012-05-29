<?php

namespace app\controllers;

use app\models\Posts;
//lets define a shortcut to the Auth class
use lithium\security\Auth;

class PostsController extends \lithium\action\Controller {

    public function index() {
        $posts = Posts::all();
        return compact('posts');
    }
	
	public function add() {
		$success = false;
		
		if (!Auth::check('default', $this->request)){
			//Redirect if not logged in
			return $this->redirect('/users/login');
		}

		if ($this->request->data) {
			$post = Posts::create($this->request->data);
			$success = $post->save();
		}
		return compact('success');
	}
}

?>