<?php

namespace app\controllers;

use app\models\Configs;
use ali3\storage\Config;
use lithium\action\DispatchException;
use lithium\net\http\Route;

class ConfigsController extends \lithium\action\Controller {

	public function index() {
		$configs = Configs::all()->data();
		return compact('configs');
	}

	public function view() {
        $name = $this->request->args[0];
        $value = Config::read('default', $name);
		return compact('name','value');
	}

	public function add() {
		$config = Configs::create();
        
        //Good for debugging requests. Just compact debug.
        //$debug = serialize($this->request);

		if (($this->request->data) && Config::write('default', $this->request->data['name'], $this->request->data['value'])) {
			return $this->redirect(array('Configs::view', 'args' => array($this->request->data['name'])));
		}
		return compact('config');
	}

	public function edit() {
        $name = $this->request->args[0];
        $value = Config::read('default', $name);

		if (!$name) {
			return $this->redirect('Configs::index');
		}
		if (($this->request->data) && Config::write('default', $this->request->data['name'], $this->request->data['value'])) {
			return $this->redirect(array('Configs::view', 'args' => array($this->request->data['name'])));
		}
		return compact('name','value');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Configs::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		//Configs::find($this->request->id)->delete();
        Config::delete('default', $this->request->args[0]);
		return $this->redirect('Configs::index');
	}

}

?>