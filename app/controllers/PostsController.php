<?php

namespace app\controllers;

use lithium\security\Auth;
use lithium\util\Set;

use app\models\Posts;
use app\models\Users;

use ali3\storage\Session;

class PostsController extends \lithium\action\Controller {

    public $publicActions = array('index','view','comment');

    public function index() {
        $limit = 10;
        $page = $this->request->page ?: 1;
        $order = array('created' => 'DESC');
        $total = Posts::count();
        $posts = Posts::all(compact('order','limit','page'));
		#Docs with examples on doing this are hard to find
		#Write about doing this: Setting the layout in controller
        $this->_render['layout'] = 'home';
        return compact('posts', 'total', 'page', 'limit');
    }

    public function add() {
		
        $success = false;

        if ($this->request->data) {
            $post = Posts::create($this->request->data);
            $success = $post->save();
            Session::write('Auth.message', 'Post added');
        }
		
    }

    public function edit() {

        $post = Posts::find('first', array('conditions' => array('slug' => $this->request->slug)));

        if (( $this->request->data )&& $post->save($this->request->data)) {
            Session::write('Auth.message', 'Post saved');
        }
		
        return compact('post');
		
    }

    public function view() {
		
		//$post = Posts::find('first', array('conditions' => array('slug' => $this->request->slug)));
		$post = Posts::find('first', array(
				'conditions'=> array('slug' => $this->request->slug),
				'with'=>array('Users')
			)
		);
		
		if (!$post) {
			Session::write('Auth.message', '404:Post not found');
			return $this->redirect('/posts/');
		}
                
        Posts::user($post);

        return compact('post');
		
    }

    public function comment() {
		
        if (!is_null($this->request->data)) {
			$id = $this->request->params['id'];
            $data = &$this->request->data;
            $query = array(
				'$push'=> array(
				'comment'=>array(
								   'title'=>$data['title'],
								   'contact'=>$data['contact'],
								   'body'=>$data['body']
								)
				)
			);
            $conditions = array('_id'=>$id);
            $result = Posts::update($query, $conditions, array('atomic' => false));
            if ($result) {
                Session::write('Auth.message', 'Comment added');
                //TODO:Don't use path and use slugs plus don't work none
                return $this->redirect("/posts/".$data['post_slug']);
                //$this->redirect(array('Posts::view', 'args' => array($data['slug'])));
            }
        }

    }

}

?>