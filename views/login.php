<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script src="../js/login.js"></script>
	<script src="../js/authorized.js"></script>
	<title>Login</title>
</head>

<body>

	<div class="container" id="form">
		<form method="POST">
			<div class="block">
				<label for="login">Логин</label>
				<input type="text" id="login">
			</div>
			<div class="block">
				<label for="password">Пароль</label>
				<input type="password" id="password">
			</div>
			<div>
				<span class="error" id="errors"></span>
			</div>
			<input type="submit" value="Войти">
			<div>
				<a href="/views/register.php">Зарегистрироваться</a>
			</div>
		</form>
	</div>
	<div class="container">
		<h1 id="user"></h1>
		<button id="exit" onclick="exitHandler()" hidden>Выйти</button>
	</div>

</body>

</html>