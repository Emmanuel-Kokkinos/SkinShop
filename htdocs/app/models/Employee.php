<?php

class Employee extends Model {

	var $username;
	var $password_hash;
	var $is_admin;

	public function find($employee_id) {
		$SQL = 'SELECT * FROM Employee WHERE employee_id = :employee_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['employee_id'=>$employee_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Employee');
		return $stmt->fetch();
	}

	public function findUser($username) {
		$SQL = 'SELECT * FROM Employee WHERE username = :username';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username'=>$username]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Employee');
		return $stmt->fetch();
	}

	public function create() {
		$SQL = 'INSERT INTO Employee(username, password_hash, is_admin) VALUES(:username, :password_hash, :is_admin)';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username'=>$this->username, 'password_hash'=>$this->password_hash, 'is_admin'=>$this->is_admin]);
		return $stmt->rowCount();
	}

	public function get() {
		$SQL = 'SELECT * FROM Employee';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Employee');
		return $stmt->fetchAll();
	}

	public function update() {
		$SQL = 'UPDATE Employee SET username = :username, is_admin = :is_admin WHERE employee_id = :employee_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username'=>$this->username, 'is_admin'=>$this->is_admin, 'employee_id'=>$this->employee_id]);
		return $stmt->rowCount();
	}

	public function delete() {
		$SQL = 'DELETE FROM Employee WHERE employee_id = :employee_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['employee_id'=>$this->employee_id]);
		return $stmt->rowCount();
	}

	public function changePassword() {
		$SQL = 'UPDATE Employee SET password_hash = :password_hash WHERE employee_id = :employee_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['password_hash'=>$this->password_hash, 'employee_id'=>$this->employee_id]);
		return $stmt->rowCount();
	}
}

?>