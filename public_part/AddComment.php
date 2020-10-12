<?php 
$artical_id = base64_decode($_POST['artical_id']);
$comment = trim($_POST['comment']);
$user_id = $_SESSION['user_id'];

if(strlen($comment) == 0){
	echo 'Error';
	die;
}

R::exec("INSERT INTO `comment`(`user_id`,`artical_id`,`comment`) VALUES(?,?,?)",
	     [$user_id,$artical_id,$comment]);

$LastComment = R::findLast('comment');
$LastComment = $LastComment -> comment;
$result = 'Comment added success';
$users = get_users();
$login = $users[0]['login'];


echo "<p>Autor: $login</p><p>Comment: $LastComment</p><div class='border'></div>";



