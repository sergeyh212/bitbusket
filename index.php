<?php
$name = 'Tom';
$age = 36;
setcookie('Name', $name);
setcookie('age', $age, time() + 3600);
echo 'Куки установлены</br>';

if (isset($_COOKIE['Name'])) echo 'Name: ' . $_COOKIE['Name'] . '</br>';
if (isset($_COOKIE['age'])) echo 'Age: ' . $_COOKIE['age'] . '</br>';

setcookie('lang[0]', 'php');
setcookie('lang[1]', 'c#');
setcookie('lang[2]', 'java');

if (isset($_COOKIE['lang'])) {
	foreach ($_COOKIE['lang'] as $name => $value) {
		$name = htmlspecialchars($name);
		$value = htmlspecialchars($value);
		echo "$name. $value</br>";
	}
}
setcookie('age', '', time() - 3600);