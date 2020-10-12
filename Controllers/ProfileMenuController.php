<?php 
# code...
class ProfileMenu{
	public function exit(){
		$mysqli = include_mysqli();
		include_once 'public_part/exit.php';
		die;
	}
}