<?php


if (isset($_COOKIE['login']) && $_POST['exit'] == 'false') {
	$data = json_encode([
		'authorized' => 'true',
		'login' => $_COOKIE['login'],
	]);

	exit($data);
} else {
	setcookie('login', '', time() - 3600);

	$data = json_encode([
		'authorized' => 'false'
	]);

	exit($data);
}
