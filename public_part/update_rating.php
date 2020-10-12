<?php 
$artical_id = $_REQUEST['artical_id'];
$rating = $_REQUEST['rating'];

$loaded = [];
$loaded[] = R::findOne('rating','artical_id=?',array($artical_id));// reading one user
$props = $loaded -> getProperties();
dump($props);
echo $loaded['rating'];


