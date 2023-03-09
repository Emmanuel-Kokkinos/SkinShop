<?php
class Controller {

	public function model($model) {
		if(file_exists('app/models/' . $model . '.php')) {
			require_once 'app/models/' . $model . '.php';
			return new $model();
		}
		else {
			return null;
		}
	}

	public function view($name, $data = []) {
		if(file_exists('app/views/' . $name . '.php')) {
			include 'app/views/' . $name . '.php';
		}
		else {
			echo "ERROR the view $name does not exist!";
		}
	}

}
?>