<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/style.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script src="../js/register.js"></script>
	<title>Register</title>
</head>

<body>

	<div class="container">
		<form method="POST">
			<div class="block">
				<label for="login">Логин</label>
				<input type="text" name="login" id="login">
				<span class="error" id="login_error"></span>
			</div>
			<div class="block">
				<label for="password">Пароль</label>
				<input type="password" name="password" id="password">
				<span class="error" id="password_error"></span>
			</div>
			<div class="block">
				<label for="confirm_password">Подтверждение пароля</label>
				<input type="password" name="confirm_password" id="confirm_password">
				<span class="error" id="confirm_password_error"></span>
			</div>
			<div class="block">
				<label for="email">Email</label>
				<input type="text" name="email" id="email">
				<span class="error" id="email_error"></span>
			</div>
			<div class="block">
				<label for="name">Имя</label>
				<input type="text" name="name" id="name">
				<span class="error" id="name_error"></span>
			</div>
			<input type="submit" value="Зарегистрироваться" class="block">
		</form>
		<a href="/views/login.php">Войти</a>

</body>

</html>