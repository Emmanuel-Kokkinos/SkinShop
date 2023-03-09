<?php

class HomeController extends Controller{

	/**
		@accessFilter:{UserFilter}
	*/
	public function index() {
		$items = $this->model('Skin_owned')->getOwned($_SESSION['user_id']);
		$user = $this->model('User')->find($_SESSION['user_id']);
		$skins = [];
		foreach($items as $owned) {
			$skin = $this->model('Skin')->find($owned->skin_id);
			array_push($skins, $skin);
		}
		$this->view('home/index', ['items'=>$items, 'user'=>$user, 'skins'=>$skins]);
	}

	public function shop() {
		$skins = $this->model('Skin')->get();
		$items = $this->model('Skin_owned')->getOwned($_SESSION['user_id']);
		$skins_owned = [];
		foreach($items as $owned) {
			$skin = $this->model('Skin')->find($owned->skin_id);
			array_push($skins_owned, $skin);
		}
		$user = $this->model('User')->find($_SESSION['user_id']);
		$skins_onsale = [];
		foreach ($skins as $skin) {
			if($skin->discount > 0) 
			{
				$skin->price *= (1 - $skin->discount);
				array_push($skins_onsale, $skin);
			}
		}
		$this->view('home/shop', ['skins'=>$skins, 'skins_owned'=>$skins_owned, 'skins_onsale'=>$skins_onsale, 'user'=>$user]);
	}

	/**
		@accessFilter:{UserFilter}
	*/
	public function cart() {
		$user = $this->model('User')->find($_SESSION['user_id']);
		$user_id = $_SESSION['user_id'];
		$skinsCart = $this->model('Skin_owned')->getCart($user_id);
		$skins = [];
		foreach ($skinsCart as $skin_id) {
			array_push($skins, $this->model('Skin')->find($skin_id->skin_id));
		}
		foreach ($skins as $skin) {
			if($skin->discount > 0) {
				$skin->price *= (1 - $skin->discount);
			}
		}
		$this->view('home/cart', ['skins'=>$skins, 'user'=>$user]);
	}

	public function changeUsername($user_id) {
		$theUser = $this->model('User')->find($user_id);
 		if($theUser->user_id != $_SESSION['user_id']) {
			header('location:/home/index');
			return;
		}

		if(isset($_POST['action'])) {
			$newUser = $this->model('User');
			$theUser = $newUser->findUser($_POST['username']);
			if($theUser == null) {
				$theUser = $this->model('User')->find($user_id);
				$theUser->username = $_POST['username'];
				$theUser->changeUsername();
				header('location:/login/logout');
			}
			$this->view('login/index', 'Username is already taken!');
		}
		else {
			$this->view('home/changeUsername', $theUser);
		}
	}

	public function changePassword($user_id) {
		$theUser = $this->model('User')->find($user_id);
 		if($theUser->user_id != $_SESSION['user_id']) {
			header('location:/home/index');
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
			$this->view('home/changePassword', $theUser);
		}
	}

	public function addToCart($skin_id) {
		$user = $_SESSION['user_id'];
		$newItem = $this->model('Skin_owned');
		$newItem->user_id = $_SESSION['user_id'];
		$newItem->skin_id = $skin_id;
		$newItem->in_cart = '1';
		$newItem->create();
		header('location:/home/shop');
	}

	public function removeFromCart($skin_id) {
		$user = $_SESSION['user_id'];
		$theItem = $this->model('Skin_owned')->getSkin($user, $skin_id);
		$theItem->remove();
		header('location:/home/cart');
	}

	public function buySkin() {
		$user = $this->model('User')->find($_SESSION['user_id']);
		$skins = $this->model('Skin_owned')->getCart($user->user_id);
		foreach($skins as $skin) {
			$eachSkin = $this->model('Skin')->find($skin->skin_id);
			if($eachSkin->discount > 0) {
				$eachSkin->price *= (1 - $eachSkin->discount);
			}
			$user->riot_points -= $eachSkin->price;
			$eachSkin->sold += $eachSkin->price;
			$eachSkin->sell();
			$user->buy();
			$skin->update();
		}
		header('location:/home/index');
	}

	public function buyRP() {
		$user = $this->model('User')->find($_SESSION['user_id']);
		if(isset($_POST['action'])) {
			$user->riot_points += $_POST['action'];
			$user->buy();
			header('location:/home/buyRP');
		}
		else {
			$this->view('home/buyRP', ['user'=>$user]);
		}
	}
}

?>