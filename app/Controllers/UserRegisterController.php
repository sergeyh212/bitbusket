<?php

include('../Models/User.php');

$user = new User(htmlentities($_POST['login']), htmlentities($_POST['password']), htmlentities($_POST['confirm_password']), htmlentities($_POST['email']), htmlentities($_POST['name']));

if ($user->isValid()) {

	User::create($user);

	$errors = json_encode(['registered' => 'true']);

	exit($errors);
} else {

	$errors = $user->getErrors();

	exit($errors);
}
