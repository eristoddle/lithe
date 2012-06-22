<?php

namespace app\controllers;

use app\models\Configs;
use lithium\action\DispatchException;

class ConfigsController extends \lithium\action\Controller {

	public function index() {
		$configs = Configs::all();
		return compact('configs');
	}

	public function view() {
		$config = Configs::first($this->request->id);
		return compact('config');
	}

	public function add() {
		$config = Configs::create();
        
        $name = $this->request;

		if (($this->request->data) && Config::write('default', 'site_title', $newTitle)) {
			return $this->redirect(array('Configs::view', 'args' => array($config->id)));
		}
		return compact('config','name');
	}

	public function edit() {
		$config = Configs::find($this->request->id);

		if (!$config) {
			return $this->redirect('Configs::index');
		}
		if (($this->request->data) && $config->save($this->request->data)) {
			return $this->redirect(array('Configs::view', 'args' => array($config->id)));
		}
		return compact('config');
	}

	public function delete() {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			$msg = "Configs::delete can only be called with http:post or http:delete.";
			throw new DispatchException($msg);
		}
		Configs::find($this->request->id)->delete();
		return $this->redirect('Configs::index');
	}
}

?>