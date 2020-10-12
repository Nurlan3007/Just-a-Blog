<?php 
Class AuthController
{
	public function MethodGet_login(){
		include_once 'pages/public/auth.php/login.php';
		die;
	} 

	public function MethodGet_register(){
		include_once 'pages/public/auth.php/register.php';
		die;
	}

	public function MethodPost_login(){
		$mysqli = include_mysqli();
		// include_readbean();
		include_once 'public_part/auth/login_user.php';
		die;
	} 

	public function MethodPost_register(){
		include_once 'public_part/auth/check_register.php';
		die;
	}

}



