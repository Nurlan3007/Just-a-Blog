<?php 
$login = rtrim($_POST['login']);
$email = rtrim($_POST['email']);
$password = rtrim($_POST['passwordFirst']);
$ConfirmPassword = rtrim($_POST['passwordSecond']);
// LOGIN
if(preg_match('/^[A-Z]{1,}+[a-zA-Z_\d]{4,}/',$login,$m) == false){
	$_SESSION['error']['login'] = 'Invalid Login';
}


if(!check_uniquens($login,'login')){
	$_SESSION['error']['login'] = 'Login already exits';
}

// EMAIL
if(preg_match('/^[A-Za-z0-9_.-]+@[A-Za-z0-9_.-]+\.+[a-z]+$/',$email,$m) == false){
	$_SESSION['error']['email'] = 'Invalid email';
}

if(!check_uniquens($email,'email')){
	$_SESSION['error']['email'] = 'Email already exits';
}

// PASSWORD
if($password != $ConfirmPassword){
	$_SESSION['error']['password'] = 'Error passsword';
}

if(strlen($password) <= 3)
	$_SESSION['error']['password'] = 'Passsword is short';


if(count($_SESSION['error']) > 0){
    header("Location:/register");
	die;
}

// INSERT IN DATABASE users

$password_hash = password_hash($password,PASSWORD_DEFAULT);
$role_id = 6;

// include_readbean();

R::exec('INSERT INTO `users`(`login`,`email`,`role_id`,`password`) VALUES(?,?,?,?)',
	array($login,$email,$role_id,$password_hash));

$last = R::findLast('users');
$_SESSION['user_id'] = $last->id;


header('Location:/');



