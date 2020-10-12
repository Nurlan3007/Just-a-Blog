<?php 
$name_artical = trim($_POST['name']);
$description  = trim($_POST['text']);
$category_id = $_POST['category'];

function chekc_name_file_uniquens($file){
	$name_file = R::findOne('images','image_path=?',[$file]);
	if(count($name_file) > 0)
		$_SESSION['error']['name_artical_2'] = 'Name image alredy exit';

}

if(preg_match('/[A-Z]{1,}[a-z0-9_-]*/',$name_artical,$m) == false)
	$_SESSION['error']['name_artical_1'] = 'Error name artical';

$type_images = ['svg','jpg','png','jfif'];
foreach ($_FILES as $value) {
	$properties = pathinfo($value['name']);
	$type_image_now = $properties['extension'];
	if(!in_array($type_image_now,$type_images))
		$_SESSION['error']['image'] = 'Error choose photo';
	// chekc_name_file_uniquens($value['name']);

}
	
if(count($_SESSION['error']) > 0){
	header('Location:/create_artical');
	die;
}

foreach ($_FILES as $value) {
	$name = $value['name'];
	$tmp_name = $value['tmp_name'];
	move_uploaded_file($tmp_name,"images/".$value['name']);
}
$user_id = $_SESSION['user_id'];

R::exec("INSERT INTO `artical`(`user_id`,`category_id`,`main_name`,`value`) VALUES(?,?,?,?)",
	array($user_id,$category_id,$name_artical,$description));

$last = R::findLast('artical');
$last_id = $last -> id;

foreach ($_FILES as $value) {
	R::exec("INSERT INTO `images`(`artical_id`,`image_path`) VALUES(?,?)", 
		array($last_id,$value['name']));
}

header('Location:/profile');



