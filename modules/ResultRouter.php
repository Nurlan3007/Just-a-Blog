<?php 
require_once 'router.php';
require_once 'route.php';

// ROUTER
$router = new Router($_SERVER['REQUEST_URI']);
$router -> get('/',function(){});
$router -> get('/login','AuthController@MethodGet_login');
$router -> get('/register','AuthController@MethodGet_register');
$router -> post('/login_post','AuthController@MethodPost_login');
$router -> post('/check_register','AuthController@MethodPost_register');

$router -> get('/profile','MainMenu@profile');
$router -> get('/exit','ProfileMenu@exit');
$router -> get('/DeleteArtical',function(){
	include_once 'public_part/delete_artical.php';
	die;
});

$router -> get('/create_artical','MainMenu@create_artical');
$router -> post('/create_artical_post','MainMenu@create_artical_post');

$router -> post('/search_post',function(){
	include_once 'public_part/search.php';
	die;
});

$router -> get('/photos',function(){
	include_once 'pages/public/photos.php';
	die;
});

$router -> get('/ArticalPage',function(){
	include_once 'pages/public/artical_page.php';
	die;
});

$router -> post('/AddComment',function(){
	include_once 'public_part/AddComment.php';
	die;
});

$router -> get('/category',function(){
	include_once 'pages/public/categories.php';
	die;
});

$router -> post('/update_rating',function(){
	include_once 'public_part/update_rating.php';
	die;
});


$router -> run();
