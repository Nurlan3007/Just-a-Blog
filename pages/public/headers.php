<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
	<link rel="stylesheet" href="../../css/header.css">
	<link rel="shortcut icon" href="images/main_photo/icons8-домен-64.png" type="image/png">
</head>
<body>
<div class="page">
	<header id="header">
		<div class="container">
			<div class="header_value">
				<div class="name_site">
					<img src="images/main_photo/icons8-домен-64.png" alt="">
					<h1>Blog</h1>
					<div class="search">
						<form action="/search_post" method="post">
							<input type="text" placeholder="Какую статью вы хотите найти?" name="SerachText">
							<img src="../../images/main_photo/search.svg" alt="">
						</form>
					</div>
				</div>
				
				<div class="right_menu">
					
					<?php if(!isset($_SESSION['user_id'])): ?>
						<div class="regas_login">
							<a href="/login">Login</a>
							<a href="/register">Register</a>
						</div>
					<?php else: ?>
						<div class="menu_header">
							<img src="images/main_photo/basket.svg" alt="">
							<img src="images/main_photo/comment.svg" alt="">
						</div>
						<div class="profile">
							<?php $users = get_users(); ?>
								<a href="/profile">
									<?=substr($users[0]['login'],0,10)?>
								</a>
						</div>
					<?php endif; ?>	

				</div>

			</div>
		</div>
	</header>
</div>	
</body>
</html>