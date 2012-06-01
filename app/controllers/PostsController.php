<?php
#TODO: Add published value, add desc, add pagination

namespace app\controllers;

use app\models\Posts;
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
			#TODO: I am pretty sure this is not the right way and need to trim
			$new_data = &$this->request->data;			
			$new_data['tags'] = explode(",",$new_data['tags']);
			$post = Posts::create($new_data);
			$success = $post->save();
		}
		return compact('success');
	}
	
	public function tags($tag){
	
		//Dont run the query if no tag is provided
		if($this->request->args[0]){
			//Get a list of post with the tag
			//TODO: Write query
			$posts = Posts::find('all', array(
				'fields' => array('tags'), 
				'order' => array('created' => 'DESC')
			));
			//Send the retrieved post data to the view
			return compact('posts');
		}
		
		//since no tag was specified, return a list of tags
		$tags = Posts::find('all', array(
				'fields' => array('tags'), 
				'order' => array('created' => 'DESC')
		));
		return compact('tags');
		
	}
	
	public function view($id=null) {
		//Dont run the query if no post id is provided
		if($id){
			//Get single record from the database where post id matches the URL
			$post = Posts::first($id);
			//Send the retrieved post data to the view
			return compact('post');
		}
		//since no post id was specified, redirect to the index page
		$this->redirect(array('Posts::index'));
	}
	
	public function comment($id=null) {
        // check to make sure the request is set
        if(!is_null($this->request->data)) {
            $data = &$this->request->data;
            //we'll set up our query
            $query = array(
                 '$push'=> array('comment'=>array(
                     'title'=>$data['title'],
                     'contact'=>$data['contact'],
                     'body'=>$data['body']
                    )
                 )
            );
		//set up the conditions
            $conditions = array('_id'=>$id);
		// execute the query
            $result = Posts::update($query, $conditions, array('atomic' => false));
        } 

        // you'll want to add checks, but for simplicity, we'll just send them back to the individual post
            $this->redirect("/posts/view/$id/");
        } 

}

?>