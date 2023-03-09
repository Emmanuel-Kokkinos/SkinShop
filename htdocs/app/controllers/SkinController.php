<?php

class SkinController extends Controller{
	/**
		@accessFilter:{EmployeeFilter}
	*/
	public function index() {
		$skins = $this->model('Skin')->get();
		$user = $_SESSION['employee_id'];
		$skins_onsale = [];
		foreach ($skins as $skin) {
			if($skin->discount > 0) 
			{
				$skin->price *= (1 - $skin->discount);
				array_push($skins_onsale, $skin);
			}
		}
		$this->view('skin/index', ['skins'=>$skins, 'user'=>$user, 'skins_onsale'=>$skins_onsale]);
	}

	/**
		@accessFilter:{EmployeeFilter}
	*/
	public function create() {
		if(isset($_POST['action'])) {
			$newSkin = $this->model('Skin');
			$newSkin->name = $_POST['name'];
			$newSkin->champion = $_POST['champion'];
			$newSkin->description = $_POST['description'];
			$newSkin->price = $_POST['price'];
			$newSkin->create();
			header('location:/skin/index');
		}
		else {
			$this->view('skin/create');
		}
	}

	public function detail($skin_id) {
		$theProduct = $this->model('Skin')->find($skin_id);
		$thePictures = $this->model('Skin')->getForSkin($skin_id);
		$theProduct->image = $thePictures;
		if($theProduct->discount > 0) {
			$theProduct->price *= (1 - $theProduct->discount);
		}
		$this->view('skin/detail', $theProduct);
	}

	public function edit($skin_id) {
		$theSkin = $this->model('Skin')->find($skin_id);
		if(isset($_POST['action'])) {
			$theSkin->name = $_POST['name'];
			$theSkin->champion = $_POST['champion'];
			$theSkin->description = $_POST['description'];
			$theSkin->price = $_POST['price'];
			$theSkin->discount = $_POST['discount'];
			$theSkin->update();
			header('location:/skin/index');
		}
		else {
			$this->view('skin/edit', $theSkin);
		}
	}

	public function delete($skin_id) {
		$theSkin = $this->model('Skin')->find($skin_id);
		if(isset($_POST['action'])) {
			$theSkin->available = '0';
			$theSkin->delete(); 
			header('location:/skin/index');
		}
		else {
			$this->view('skin/delete', $theSkin);
		}
	}

	public function addPicture($skin_id) {
		if(isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
			$info = getimagesize($_FILES['image']['tmp_name']);
			$allowedTypes = [IMAGETYPE_JPEG=>'.jpg', IMAGETYPE_PNG=>'.png', IMAGETYPE_GIF=>'.gif'];

			if($info === false) {
				$this->view('skin/addPicture', ['error '=>'Bad file format']);
			}
			else if(!array_key_exists($info[2], $allowedTypes)) {
				$this->view('skin/addPicture', ['error '=>'Not an accepted file type']);
			}
			else {
				$path = getcwd().DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
				$image = uniqid() . $allowedTypes[$info[2]];
				move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);

				$newPicture = $this->model('Skin')->find($skin_id);
				$newPicture->image = $image;
				$newPicture->addPicture();
				header('location:/skin/index');
			}
		}
		else {
			$this->view('skin/addPicture');
		}
	}

	public function deletePicture($skin_id) {
		$thePicture = $this->model('Skin')->find($skin_id);
		unlink(getcwd().DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $thePicture->image);
		$thePicture->deletePicture();
		header('location:/skin/index');
	}
}

?>