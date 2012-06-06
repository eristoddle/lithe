<?php
#TODO: Add published value, add desc, add pagination

namespace app\controllers;

use app\models\Posts;
use lithium\security\Auth;

class PostsController extends \lithium\action\Controller {

    public function index() {
        $posts = Posts::all();
		//$posts = Post::all(array('order' => array('created' => 'DESC')));
		#Docs with examples on doing this are hard to find
		#Write about doing this
		$this->_render['layout'] = 'home';
        return compact('posts');
    }
	
	public function add() {
		$success = false;
		
		if (!Auth::check('default', $this->request)){
			return $this->redirect('/users/login');
		}

		if ($this->request->data) {
			#TODO: I am pretty sure this is not the right way and need to trim
			$new_data = &$this->request->data;			
			$new_data['tags'] = explode(",",$new_data['tags']);
			$post = Posts::create($new_data);
			$success = $post->save();
		}
		return compact('success');
	}
	
	public function view($id=null) {
		if($id){
			$post = Posts::first($id);
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
        } 

            $this->redirect("/posts/view/$id/");
			
        } 

}

?>