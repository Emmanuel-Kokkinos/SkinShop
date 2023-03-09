<?php

class User extends Model {

	var $username;
	var $password_hash;
	var $riot_points;

	public function find($user_id) {
		$SQL = 'SELECT * FROM User WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		return $stmt->fetch();
	}

	public function get() {
		$SQL = 'SELECT * FROM User';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		return $stmt->fetchAll();
	}

	public function findUser($username) {
		$SQL = 'SELECT * FROM User WHERE username = :username';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username'=>$username]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		return $stmt->fetch();
	}

	public function create() {
		$SQL = 'INSERT INTO User(username, password_hash) VALUES(:username, :password_hash)';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username'=>$this->username, 'password_hash'=>$this->password_hash]);
		return $stmt->rowCount();
	}

	public function changeUsername() {
		$SQL = 'UPDATE User SET username = :username WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['username'=>$this->username, 'user_id'=>$this->user_id]);
		return $stmt->rowCount();
	}

	public function changePassword() {
		$SQL = 'UPDATE User SET password_hash = :password_hash WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['password_hash'=>$this->password_hash, 'user_id'=>$this->user_id]);
		return $stmt->rowCount();
	}

	public function buy() {
		$SQL = 'UPDATE User SET riot_points = :riot_points WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['riot_points'=>$this->riot_points, 'user_id'=>$this->user_id]);
		return $stmt->rowCount();
	}

	public function giveRP() {
		$SQL = 'UPDATE User SET riot_points = :riot_points WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['riot_points'=>$this->riot_points, 'user_id'=>$this->user_id]);
		return $stmt->rowCount();
	}
}

?>