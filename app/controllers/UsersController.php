<?php
namespace app\controllers;

//lets define a shortcut to the Auth class
use lithium\security\Auth;
//and a shortcut to our Users model
use app\models\Users;

class UsersController extends \lithium\action\Controller {
    
    public function index() {
        $users = Users::all();
        return compact('users');
    }
	
	public function add(){
	
		#TODO: Slugs
		#http://blog.amalraghav.com/lithium-filters-a-practical-example/
		
		$register = NULL;
		
		if (!Auth::check('default', $this->request)){
			//Redirect if not logged in
			return $this->redirect('/users/login');
		}

		if ( $this->request->data ){
			$register = Users::create($this->request->data);
			if ( $register->save() ){
				$this->redirect('/users/');
			}

		}
		$data = $this->request->data;

		return compact('register','data');
	}
	
	#TODO: Make Login and Logout Filters - See Steve's code
	#And http://dev.lithify.me/drafts/source/en/02_lithium_basics/02_filters.wiki
	public function login() {
		//assume there's no problem with authentication
		$noauth = false;
		//perform the authentication check and redirect on success
		if (Auth::check('default', $this->request)){
			//Redirect on successful login
			return $this->redirect('/');
		}
		//if theres still post data, and we weren't redirected above, then login failed
		if ($this->request->data){
			//Login failed, trigger the error message
			$noauth = true;
		}
		//Return noauth status
		return compact('noauth');
	}
	
	public function logout() {
        Auth::clear('default');
        return $this->redirect('/');
    }

}

?>