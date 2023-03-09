<?php

class LoginController extends Controller {

	public function index() {
		if(isset($_POST['userAction'])) {
			$theUser = $this->model('User')->findUser($_POST['username']);
			if($theUser != null && password_verify($_POST['password'], $theUser->password_hash)) {
				$_SESSION['user_id'] = $theUser->user_id;
				header('location:/home/index');
			}
			else {
				$this->view('login/register', 'Incorrect username/passwords combination!');
			}
		}
		else if(isset($_POST['employeeAction'])) {
			$theUser = $this->model('Employee')->findUser($_POST['username']);
			if($theUser != null && password_verify($_POST['password'], $theUser->password_hash)) {
				$_SESSION['employee_id'] = $theUser->employee_id;
				$_SESSION['is_admin'] = $theUser->is_admin;
				header('location:/skin/index');
			}
			else {
				$this->view('login/register', 'Incorrect username/passwords combination!');
			}
		}
		else {
			$this->view('login/index');
		}
	}

	public function register() {
		if(isset($_POST['action'])) {
			$newUser = $this->model('User');
			$theUser = $newUser->findUser($_POST['username']);
			if($theUser == null && $_POST['password'] == $_POST['password_confirm']) {
				$newUser->username = $_POST['username'];
				$newUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$newUser->create();
				header('location:/home/index');
			}
			$this->view('login/register', 'Username already in use or passwords did not match!');
		}
		else {
			$this->view('login/register');
		}
	}

	public function logout() {
		session_destroy();
		header('location:/login/index');
	}
}

?>