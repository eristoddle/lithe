<?php
namespace app\controllers;

use app\models\Posts;

use lithium\security\Auth;
use lithium\storage\Session;

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
            Session::write('message', 'Post added');
        }
    }

    public function edit() {

		$post = Posts::find('first', array('conditions' => array('slug' => $this->request->slug)));

        if (( $this->request->data )&& $post->save($this->request->data)) {
            Session::write('message', 'Post saved');
        }
        return compact('post');
    }

    public function view() {
		
		//$post = Posts::find($this->request->params['id']);
		$post = Posts::find('first', array('conditions' => array('slug' => $this->request->slug)));
		
		if (!$post) {
			Session::write('message', '404:Post not found');
			return $this->redirect('/posts/');
		}

        return compact('post');
		
    }

    public function comment() {
        if (!is_null($this->request->data)) {
			$id = $this->request->params['id'];
            $data = &$this->request->data;
            $query = array(
				 '$push'=> array('comment'=>array(
											   'title'=>$data['title'],
											   'contact'=>$data['contact'],
											   'body'=>$data['body']
										   )
								)
			 );
            $conditions = array('_id'=>$id);
            $result = Posts::update($query, $conditions, array('atomic' => false));
            if ($result) {
                Session::write('message', 'Comment added');
            }
        }

#TODO:Don't use path and use slugs
        $this->redirect("/posts/view/$id/");

    }

}


?>