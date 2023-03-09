<?php 

class Skin_owned extends Model{
	var $image;
	var $skin_id;
	var $available;
	var $discount;
	var $user_id;
	var $in_cart;

	public function get($user_id) {
		$SQL = 'SELECT * FROM Skin_owned WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin_owned');
		return $stmt->fetchAll();
	}

	public function getCart($user_id) {
		$SQL = "SELECT * FROM Skin_owned WHERE user_id = :user_id && in_cart = '1'";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin_owned');
		return $stmt->fetchAll();
	}

	public function getAll() {
		$SQL = "SELECT * FROM Skin_owned";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin_owned');
		return $stmt->fetchAll();
	}

	public function getForUser($user_id) {
		$SQL = 'SELECT * FROM Skin WHERE user_id = :user_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin');
		return $stmt->fetchAll();
	}

	public function getOwned($user_id) {
		$SQL = "SELECT * FROM Skin_owned WHERE user_id = :user_id && in_cart = '0'";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin_owned');
		return $stmt->fetchAll();
	}

	public function getForSkin($skin_id) {
		$SQL = 'SELECT image FROM Skin WHERE skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['skin_id'=>$skin_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin');
		return $stmt->fetch();
	}

	public function find($skin_id) {
		$SQL = 'SELECT * FROM Skin WHERE skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['skin_id'=>$skin_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin');
		return $stmt->fetch();
	}

	public function create() {
		$SQL = "INSERT INTO Skin_owned(user_id, skin_id, in_cart) VALUE(:user_id, :skin_id, :in_cart)";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$this->user_id, 'skin_id'=>$this->skin_id, 'in_cart'=>$this->in_cart]);
		return $stmt->rowCount();
	}

	public function getSkin($user_id, $skin_id) {
		$SQL = 'SELECT * FROM Skin_owned WHERE user_id = :user_id && skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id, 'skin_id'=>$skin_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin_owned');
		return $stmt->fetch();
	}

	public function remove() {
		$SQL = "DELETE FROM Skin_owned WHERE skin_id = :skin_id && user_id = :user_id";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['skin_id'=>$this->skin_id, 'user_id'=>$this->user_id]);
		return $stmt->rowCount();
	}

	public function update() {
		$SQL = "UPDATE Skin_owned SET in_cart = '0' WHERE user_id = :user_id && skin_id = :skin_id";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$this->user_id, 'skin_id'=>$this->skin_id]);
		return $stmt->rowCount();
	}
}

?>