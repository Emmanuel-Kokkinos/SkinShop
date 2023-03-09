<?php 

class Skin extends Model{
	var $name;
	var $champion;
	var $description;
	var $price;
	var $image;
	var $sold;
	var $skin_id;
	var $available;
	var $discount;

	public function get() {
		$SQL = "SELECT * FROM Skin WHERE available = '1'";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin');
		return $stmt->fetchAll();
	}

	public function getForUser($user_id) {
		$SQL = "SELECT * FROM Skin WHERE user_id = :user_id && in_cart == '0'";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['user_id'=>$user_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin');
		return $stmt->fetchAll();
	}

	public function getForSkin($skin_id) {
		$SQL = 'SELECT image FROM Skin WHERE skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['skin_id'=>$skin_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin');
		return $stmt->fetch();
	}

	public function create() {
		$SQL = 'INSERT INTO Skin(name, champion, description, price) VALUE(:name, :champion, :description, :price)';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['name'=>$this->name, 'champion'=>$this->champion, 'description'=>$this->description, 'price'=>$this->price]);
		return $stmt->rowCount();
	}

	public function find($skin_id) {
		$SQL = 'SELECT * FROM Skin WHERE skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['skin_id'=>$skin_id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Skin');
		return $stmt->fetch();
	}

	public function update() {
		$SQL = 'UPDATE Skin SET name = :name, champion = :champion, description = :description, price = :price, 
			discount = :discount WHERE skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['name'=>$this->name, 'champion'=>$this->champion, 'description'=>$this->description, 'price'=>$this->price, 
			'discount'=>$this->discount, 'skin_id'=>$this->skin_id]);
		return $stmt->rowCount();
	}

	public function delete() {
		$SQL = "UPDATE Skin SET available = :available WHERE skin_id = :skin_id";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['available'=>$this->available, 'skin_id'=>$this->skin_id]);
		return $stmt->rowCount();
	}

	public function addPicture() {
		$SQL = 'UPDATE Skin SET image = :image WHERE skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['image'=>$this->image, 'skin_id'=>$this->skin_id]);
		return $stmt->rowCount();
	}

	public function deletePicture() {
		$SQL = 'UPDATE Skin SET image = NULL WHERE skin_id = :skin_id';
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['skin_id'=>$this->skin_id]);
		return $stmt->rowCount();
	}

	public function sell() {
		$SQL = "UPDATE Skin SET sold = :sold WHERE skin_id = :skin_id";
		$stmt = self::$_connection->prepare($SQL);
		$stmt->execute(['sold'=>$this->sold, 'skin_id'=>$this->skin_id]);
		return $stmt->rowCount();
	}

	public static function cmp_name($a, $b) {
		return strcmp($a->name, $b->name);
	}

	public static function cmp_price($a, $b) {
		return $a->price > $b->price;
	}
}

?>