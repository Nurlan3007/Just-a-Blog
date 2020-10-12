<?php 
$temporary_login = trim($_POST['login']);
$temporary_login = strtolower($temporary_login);
$login = ucfirst($temporary_login);
$password = trim($_POST['password']);

$get_user = R::find('users',"login=?",[$login]);
$got_user = R::exportAll( $get_user );

if(count($got_user) == 0)
	$_SESSION['error']['login'] = 'Users don`t exit';

if(count($_SESSION['error']) > 0){
	header('Location:/login');
	die;
}
echo $got_user['login'];

if(!password_verify($password, $got_user[0]['password'])){
	$_SESSION['error']['password'] = 'Wrong password';
}

if(count($_SESSION['error']) > 0){
	header('Location:/login');
	die;
}

// create token

$user_id = $got_user[0]['id'];
$token = md5($user_id);

$user = R::load('users',$user_id);
$user -> token = $token;
R::store($user);

setcookie('token',$token,time() + 60 * 60 * 24 * 31,"/");
$_SESSION['user_id'] = $got_user['id'];
header('Location:/');
