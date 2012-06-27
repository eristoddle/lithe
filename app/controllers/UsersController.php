<?php
namespace app\controllers;

use lithium\security\Auth;

use app\models\Users;

use ali3\storage\Session;

class UsersController extends \lithium\action\Controller {

    public $publicActions = array('login','logout','index','view');

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
                Session::write('Auth.message', 'User added');
                $this->redirect('Users::index');
            }

        }
		
        $user = $this->request->data;

        return compact('register','user');
    }

    public function edit() {

        $user = Users::find($this->request->params['id']);

        if (!$user) {
            Session::write('Auth.message', 'Please Login');
            return $this->redirect('Users::login');
        }

        if (( $this->request->data )&& $user->save($this->request->data)) {
            $register = Users::create($this->request->data);
            Session::write('Auth.message', 'User saved');
            $this->redirect(array('Users::view', 'args' => array($user->id)));
        }

        return compact('user');
		
    }

    public function login() {
        if (Auth::check('admin', $this->request)) {
            Session::write('Auth.message', 'Login success');
            return $this->redirect('/');
        }
        
        if (Auth::check('editor', $this->request)) {
            Session::write('Auth.message', 'Login success');
            return $this->redirect('/');
        }
        
        if (Auth::check('contributor', $this->request)) {
            Session::write('Auth.message', 'Login success');
            return $this->redirect('/');
        }
        
        if (Auth::check('default', $this->request)) {
            Session::write('Auth.message', 'Login success');
            return $this->redirect('/');
        }
        
        if ($this->request->data) {
            Session::write('Auth.message', 'Incorrect Username/Password Combination');
        }
    }

    public function logout() {
        Auth::clear('default');
        Auth::clear('contributor');
        Auth::clear('editor');
        Auth::clear('admin');
        Session::write('Auth.message', 'Logout success');
        return $this->redirect('/');
    }

}

?>