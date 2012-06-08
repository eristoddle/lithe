<?php
namespace app\controllers;

use app\models\Users;

use lithium\security\Auth;
use lithium\storage\Session;

class UsersController extends \lithium\action\Controller {
    
    public function index() {
        $users = Users::all();
        return compact('users');
    }
	
	public function view($id=null) {
		if($id){
			$user = Users::first($id);
			return compact('user');
		}
		else{
			$this->redirect(array('Users::index'));
		}
    }
	
	public function add(){
		
		$register = NULL;
		
 		if (!Auth::check('default', $this->request)){
			return $this->redirect('Users::login');
		}

		if ( $this->request->data ){
			$register = Users::create($this->request->data);
			if ( $register->save() ){
				$this->redirect('Users::index');
				Session::write('message', 'User added');
			}

		}
		$user = $this->request->data;

		return compact('register','user');
	}
	
	public function edit($id=null){
	
		#TODO: Edit User not hashing password
	
		if (!Auth::check('default', $this->request)){
			return $this->redirect('Users::login');
		}
		
		$user = Users::find($id);
		
		if (!$user){
			return $this->redirect('Users::login');
		}

		if (( $this->request->data )&& $user->save($this->request->data)){
			$register = Users::create($this->request->data);
			$this->redirect(array('Users::view', 'args' => array($user->id)));
			Session::write('message', 'User saved');
		}

		return compact('user');
	}
	
	#TODO: Make Login and Logout Filters - See Steve's code
	#And http://dev.lithify.me/drafts/source/en/02_lithium_basics/02_filters.wiki
	public function login() {
		if (Auth::check('default', $this->request)){
			return $this->redirect('/');
		}
		if ($this->request->data){
			$noauth = true;
		}
		return compact('noauth');
	}
	
	public function logout() {
        Auth::clear('default');
        return $this->redirect('/');
    }

}

?>