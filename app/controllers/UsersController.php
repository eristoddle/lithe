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
		$register = NULL;

		if ( $this->request->data ){
			$register = Users::create($this->request->data);
			if ( $register->save() ){
				$this->redirect('/users/');
			}

		}
		$data = $this->request->data;

		return compact('register','data');
	}

}

?>