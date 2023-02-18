<?php


if ($_COOKIE['auth'] == 'true' && $_POST['exit'] == 'false') {
	$data = json_encode([
		'authorized' => 'true',
		'login' => $_COOKIE['login'],
	]);
	
	exit($data);
} else {
	setcookie('aut', 'false');
	session_destroy();

	$data = json_encode([
		'authorized' => 'false'
	]);
	
	exit($data);
}