<?php

include('../Models/User.php');

$user = new User(htmlentities($_POST['login']), htmlentities($_POST['password']), null, null, 0);

if ($user->authorized()) {
	setcookie('login', $_POST['login']);

	$data = json_encode([
		'authorized' => 'true',
		'login' => $_POST['login'],
	]);

	exit($data);
} else {

	$errors = $user->getErrors();

	exit($errors);
}
