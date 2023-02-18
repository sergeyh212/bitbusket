<?php

include('../Models/User.php');

$user = new User($_POST['login'], $_POST['password'], null, null, 0);

if ($user->authorized()) {
	session_start();
	setcookie('login', $_POST['login']);
	setcookie('aut', 'true');

	$data = json_encode([
		'authorized' => 'true',
		'login' => $_COOKIE['login']
	]);

	exit($data);
} else {

	$errors = $user->getErrors();

	exit($errors);
}
