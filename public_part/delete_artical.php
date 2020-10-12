<?php 
# code...
$ArticalId = $_GET['AtclId'];

R::exec("DELETE FROM `images`  WHERE `artical_id` = ?",array($ArticalId));
R::exec("DELETE FROM `comment` WHERE `artical_id` = ?",array($ArticalId));
R::exec("DELETE FROM `rating`  WHERE `artical_id` = ?",array($ArticalId));
R::exec("DELETE FROM `saved`   WHERE `artical_id` = ?",array($ArticalId));
R::exec("DELETE FROM `artical` WHERE `id` = ?",array($ArticalId));
setcookie('succes','Удаление прошло успешно',60,'/');

header('Location:/profile');
