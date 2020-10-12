<?php check_login();  ?>
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
		
		<form action="/check_register" method="post" autocomplete="off" class="auth_form">
			<h1>Register</h1>
			
				<p><?=print_error('login')?></p>
				<p><?=print_error('email')?></p>
				<p><?=print_error('password')?></p>
			
			<div class="form_group">
				<label>Login</label>
				<input type="text" name="login" placeholder="Write login">
			</div>
			<div class="form_group">
				<label>Email</label>
				<input type="text" name="email" placeholder="Write email">
			</div>
			<div class="form_group">
				<label>Password</label>
				<input type="password" name="passwordFirst" placeholder="Write password">
			</div>
			<div class="form_group">
				<input type="password" name="passwordSecond" placeholder="Confirm password">
			</div>
			<div class="form_group">
				<input type="submit" value="Register">
				<a href="/login">Есть аккаунта авторизируйся!</a>
			</div>
		</form>
	</div>
</div>
</body>
</html>