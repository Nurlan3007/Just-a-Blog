<?php 
// Constants
define('PORT','127.0.0.1');
define('DB_Password','');
define('DB_Schema','blog');
define('DB_Name','root');


require_once 'rb/rb.php';
function dump($array = []){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}


function include_mysqli(){
	$mysqli = new mysqli(PORT,DB_Name,DB_Password,DB_Schema);
	return $mysqli;
}

function include_readbean(){
	R::setup('mysql:host=127.0.0.1;dbname=blog','root','');
	R::freeze(false);
	if(!R::testConnection()){
		die('Error connect');
	}
}

include_readbean();
$mysqli = include_mysqli();

// check uniquens in database
function check_uniquens($name,$act){
	$mysqli = include_mysqli();

	if($act == 'login'){
		$check_uniquens = $mysqli -> prepare("SELECT count(*) as count FROM `users` WHERE `login` = ?");
		$check_uniquens -> bind_param('s',$name);
		$check_uniquens -> execute();
		$result = $check_uniquens -> get_result();
		$uniquens = $result -> fetch_assoc();
		if($uniquens['count'] == 1)
			return false;

	}elseif ($act == 'email') {
		$check_uniquens = $mysqli -> prepare("SELECT count(*) as count FROM `users` WHERE email = ?");
		$check_uniquens -> bind_param('s',$name);
		$check_uniquens -> execute();
		$result = $check_uniquens -> get_result();
		$uniquens = $result -> fetch_assoc();
		if($uniquens['count'] == 1)
			return false;
	}
	return True;
}

// print Errors
function print_error($ErrorName){
	$value = $_SESSION['error'][$ErrorName];
	unset($_SESSION['error'][$ErrorName]);
	return $value;
}

// get categories articales
function get_categories(){
	$mysqli = include_mysqli();
	$categories = R::findAll('catogries','ORDER BY `id` DESC');
	$categories = R::exportAll($categories);
	return $categories;
}

// get users
function get_users(){
	$mysqli = include_mysqli();
	$users = R::load('users',$_SESSION['user_id']);
	$users = R::exportAll($users);
	return $users;
}

// tokens

function token(){
	$mysqli = include_mysqli();
	$token_value = $_COOKIE['token'];
	$select_user = $mysqli -> prepare("SELECT * FROM `users` WHERE `token` = ? ");
	$select_user -> bind_param('s',$token_value);
	$select_user -> execute();
	$result = $select_user -> get_result();
	$selected_user = $result -> fetch_assoc();
	$_SESSION['user_id'] = $selected_user['id'];
}

function get_date_created($time){
	$time = new DateTime($time);
	return date_format($time,"d:m:Y"); 
}

function check_login(){
	if(isset($_SESSION['user_id'])){
		die('Что вы тут забыли ;)');
	}
}


