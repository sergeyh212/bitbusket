<?php

include('../Models/User.php');

$user = new User($_POST['login'], $_POST['password'], $_POST['confirm_password'], $_POST['email'], $_POST['name']);

if ($user->isValid()) {

	User::create($user);

	$errors = json_encode(['registered' => 'true']);

	exit($errors);
} else {

	$errors = $user->getErrors();

	exit($errors);
}
