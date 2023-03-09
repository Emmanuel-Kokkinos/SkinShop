<?php

class EmployeeController extends Controller{

	public function index() {
		$employees = $this->model('employee')->get();
		$this->view('employee/index', ['employees'=>$employees]);
	}

	public function user() {
		$users = $this->model('user')->get();
		$this->view('employee/user', ['users'=>$users]);
	}

	/**
		@accessFilter:{AdminFilter}
	*/
	public function create() {
		if(isset($_POST['action'])) {
			$newEmployee = $this->model('Employee');
			$theEmployee = $newEmployee->findUser($_POST['username']);
			if($theEmployee == null && $_POST['password'] == $_POST['password_confirm']) {
				$newEmployee->username = $_POST['username'];
				$newEmployee->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				if(isset($_POST['is_admin'])) {
    				$newEmployee->is_admin = $_POST['is_admin'];
    			}
    			else {
    				$newEmployee->is_admin = '0';
    			}
				$newEmployee->create();
				header('location:/employee/index');
			}
			$this->view('employee/create', 'Username already in use or passwords did not match!');
		}
		else {
			$this->view('employee/create');
		}
	}

	/**
		@accessFilter:{AdminFilter}
	*/
	public function edit($employee_id) {
		$theEmployee = $this->model('Employee')->find($employee_id);
		if(isset($_POST['action'])) {
			$newEmployee = $this->model('Employee');
			$theEmployee = $newEmployee->findUser($_POST['username']);
			if($theEmployee == null) {
				$theEmployee = $this->model('Employee')->find($employee_id);
				$theEmployee->username = $_POST['username'];
				if(isset($_POST['is_admin'])) {
					$theEmployee->is_admin = $_POST['is_admin'];
				}
				else {
					$theEmployee->is_admin = '0';
				}
				$theEmployee->update();
				header('location:/employee/index');
			}
			$this->view('login/index', 'Username is already taken!');
		}
		else {
			$this->view('employee/edit', $theEmployee);
		}
	}

	/**
		@accessFilter:{AdminFilter}
	*/
	public function delete($employee_id) {
		$theEmployee = $this->model('Employee')->find($employee_id);
		if(isset($_POST['action'])) {
			$theEmployee->delete();
			header('location:/employee/index');
		}
		else {
			$this->view('employee/delete', $theEmployee);
		}
	}

	public function changePassword($employee_id) {
		$theUser = $this->model('Employee')->find($employee_id);
 		if($theUser->employee_id != $_SESSION['employee_id']) {
			header('location:/skin/index');
			return;
		}

		if(isset($_POST['action'])) { 
			if($_POST['password'] == $_POST['password_confirm']) {
				$theUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$theUser->changePassword();
				header('location:/login/logout');
			}
			$this->view('login/index', 'Passwords did not match!');
		}
		else {
			$this->view('employee/changePassword', $theUser);
		}
	}

	public function giveRP($user_id) {
		$theUser = $this->model('User')->find($user_id);
		if(isset($_POST['action'])) {
			$theUser->riot_points += $_POST['amount'];
			$theUser->giveRP();
			header('location:/employee/user');
		}
		else {
			$this->view('employee/giveRP', $theUser->user_id);
		}
	}
}

?>