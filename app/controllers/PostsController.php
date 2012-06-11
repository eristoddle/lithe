<?php
namespace app\controllers;

use app\models\Posts;

use lithium\security\Auth;
use lithium\storage\Session;

class PostsController extends \lithium\action\Controller {

    public function index() {
		$posts = Posts::all(array('order' => array('created' => 'DESC')));
		#Docs with examples on doing this are hard to find
		#Write about doing this
		$this->_render['layout'] = 'home';
        return compact('posts');
    }
	
	public function add() {
		$success = false;
		
		if (!Auth::check('default', $this->request)){
			Session::write('message', 'Please Login');
			return $this->redirect('Users::login');
		}

		if ($this->request->data) {
			$post = Posts::create($this->request->data);
			$success = $post->save();
			Session::write('message', 'Post added');
		}
	}
	
	public function edit($id=null) {
		
		if (!Auth::check('default', $this->request)){
			Session::write('message', 'Please Login');
			return $this->redirect('Users::login');
		}
		
		$post = Posts::find($id);

		if (( $this->request->data )&& $post->save($this->request->data)) {
			$post = Posts::create($this->request->data);
			$success = $post->save();
			Session::write('message', 'Post saved');
		}
		return compact('post');
	}
	
	public function view($id=null) {
		if($id){
			$post = Posts::first($id);
			#TODO: Find where to implode tags
			return compact('post');
		}
		$this->redirect(array('Posts::index'));
	}
	
	public function comment($id=null) {
        if(!is_null($this->request->data)) {
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

			#TODO:Don't use path
            $this->redirect("/posts/view/$id/");
			
        } 

}

?>