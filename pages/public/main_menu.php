<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../css/main_menu.css">
	<title>Document</title>
</head>
<body>
<div class="menu">
	<h2>Menu</h2>
	<nav class="main_menu">
		<ul>
			<?php if(isset($_SESSION['user_id'])): ?>
				<li><a href="/profile">Profile</a><img src="images/main_photo/iconfinder_Rounded-31_2024644.png" alt=""></li>
			<?php else: ?>
				<li><a href="/login">Login</a><img src="images/main_photo/iconfinder_Rounded-31_2024644.png" alt=""></li>	
				<li><a href="/register">Register</a><img src="images/main_photo/pen.svg" alt=""></li>
			<?php endif; ?>	
			<li><a href="">Cart</a><img src="images/main_photo/basket.svg" alt=""></li>
			<?php if(isset($_SESSION['user_id'])): ?>
				<li><a href="">Message</a><img src="images/main_photo/comment.svg" alt=""></li>
				<li><a href="/create_artical">Create artical</a><img src="../../images/main_photo/plus.svg" alt=""></li>
			<?php endif; ?>	
		</ul>
	</nav>	
</div>
	
</body>
</html>