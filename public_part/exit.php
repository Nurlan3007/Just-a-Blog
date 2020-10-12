<?php 
if(isset($_COOKIE['token'])){
	setcookie('token','1234',time() - 60 * 60 * 24 * 31 * 2);
	$user_id = $_SESSION['user_id'];
	$new_token = 1;
	$user = R::load('users',$_SESSION['user_id']);
	$user -> token = '1';
	R::store($user);

}

unset($_SESSION['user_id']);   
// session_destroy();  
header('Location:/');

