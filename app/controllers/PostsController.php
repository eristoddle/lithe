<?php

namespace app\controllers;

use app\models\Posts;
//lets define a shortcut to the Auth class
use lithium\security\Auth;

class PostsController extends \lithium\action\Controller {

    public function index() {
        $posts = Posts::all();
		//$posts = Post::all(array('order' => array('created' => 'DESC')));
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
	
	public function view() {
		//Dont run the query if no post id is provided
		if($this->request->args[0]){
			//Get single record from the database where post id matches the URL
			$post = Posts::first($this->request->args[0]);
			//Send the retrieved post data to the view
			return compact('post');
		}
		//since no post id was specified, redirect to the index page
		$this->redirect(array('Posts::index'));
	}
}

?>