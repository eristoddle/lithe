<?php
namespace app\controllers;

use app\models\Users;

use lithium\security\Auth;
use lithium\storage\Session;

class UsersController extends \lithium\action\Controller {

    public $publicActions = array('login','index','view');

    public function index() {
        $users = Users::all();
        return compact('users');
    }

    public function view() {
        if ($this->request->params['id']) {
            $user = Users::first($this->request->params['id']);
            return compact('user');
        }
        else {
            $this->redirect(array('Users::index'));
        }
    }

    public function add() {

        $register = NULL;

        if ( $this->request->data ) {
            $register = Users::create($this->request->data);
            if ( $register->save() ) {
                Session::write('message', 'User added');
                $this->redirect('Users::index');
            }

        }
		
        $user = $this->request->data;

        return compact('register','user');
    }

    public function edit() {

        $user = Users::find($this->request->params['id']);

        if (!$user) {
            Session::write('message', 'Please Login');
            return $this->redirect('Users::login');
        }

        if (( $this->request->data )&& $user->save($this->request->data)) {
            $register = Users::create($this->request->data);
            Session::write('message', 'User saved');
            $this->redirect(array('Users::view', 'args' => array($user->id)));
        }

        return compact('user');
		
    }

    public function login() {
        if (Auth::check('default', $this->request)) {
            Session::write('message', 'Login success');
            return $this->redirect('/');
        }
        if ($this->request->data) {
            Session::write('message', 'Incorrect Username/Password Combination');
        }
    }

    public function logout() {
        Auth::clear('default');
        Session::write('message', 'Logout success');
        return $this->redirect('/');
    }

}

?>