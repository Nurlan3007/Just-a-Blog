<?php check_login(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../../../css/auth.css">
</head>
<body>
<div class="page">
	<div class="block_form">
		<form action="/login_post" method="post" autocomplete="off" class="auth_form">
			<h1>Login</h1>
			<p>
				<?=print_error('login')?>
				<?=print_error('password')?>
			</p>
			<div class="form_group">
				<label>Login</label>
				<input type="text" name="login" placeholder="Write login">
			</div>
			<div class="form_group">
				<label>Password</label>
				<input type="password" name="password" placeholder="Write password">
			</div>
			<div class="form_group">
				<input type="submit" value="Login">
				<a href="/register">Нет аккаунта зарегиструйся!</a>
			</div>
		</form>
	</div>
</div>
</body>
</html>