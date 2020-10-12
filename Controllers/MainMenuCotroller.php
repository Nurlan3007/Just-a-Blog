<?php 
class MainMenu{
	public function profile(){
		include_once 'pages/public/profile.php';
		die;
	}

	public function create_artical(){
		$mysqli = include_mysqli();
		include_once 'pages/public/create_artical.php';
		die;
	}

	public function create_artical_post(){
		include_once 'public_part/create_artical.php';
	die;

	}
}