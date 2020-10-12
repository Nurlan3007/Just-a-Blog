<?php 
$text = trim($_POST['SerachText']);
$text = str_replace(" ","",$text);

$result_search = R::getAll("SELECT * FROM `artical` WHERE `main_name` like ?",["%$text%"]);



include_once 'pages/public/search.php';