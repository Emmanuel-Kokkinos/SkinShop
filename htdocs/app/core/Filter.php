<?php

class Filter extends Controller {

	public static function itemOwner($params) {
		$theItem = self::model('Item')->find($params[0]);
		if($theItem->user_id != $_SESSION['user_id']) {
			return'/home/index';
		}
		else {
			return false;
		}
	}

	//good to filter for any user
	public static function UserFilter($params) {
		if($_SESSION['user_id'] == null) {
			return '/login/index';
		}
		else {
			return false;
		}
	}

	public static function EmployeeFilter($params) {
		if($_SESSION['employee_id'] == null) {
			return '/login/index';
		}
		else {
			return false;
		}
	}

	public static function AdminFilter($params) {
		if($_SESSION['is_admin'] != '1') {
			return '/login/index';
		}
		else {
			return false;
		}
	}
}

?>