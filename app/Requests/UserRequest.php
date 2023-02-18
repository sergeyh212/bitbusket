<?php

class UserRequest
{

	private $errors = [];
	private $isValid = 1;

	public function validation($login, $password, $confirmPassword, $email, $name)
	{
		$regexPassword = '/(?=.*[a-za-яё])(?=.*[0-9])([\w])/ui';
		$regexName = '/(^[a-za-яё]+$)/ui';

		$path = $_SERVER['DOCUMENT_ROOT'] . '/database/UserDatabase.json';
		$users = json_decode(file_get_contents($path, true))->users;

		if (strlen($login) < 5)
			$this->errors['loginError'] = 'Недопустимый логин!';

		if (!preg_match($regexPassword, $password ?? '') || strlen($password) < 5)
			$this->errors['passwordError'] = 'Недопустимый пароль!';

		if ($confirmPassword !== $password || $confirmPassword == '') {
			$this->errors['confirmPasswordError'] = 'Пароли не соответствуют!';
		}

		if (!preg_match($regexName, $name ?? '') || strlen($name) < 1)
			$this->errors['nameError'] = 'Недопустимое имя!';

		if ($email === '')
			$this->errors['emailError'] = 'Неправильный email!';

		$this->loginUniqueness($login, $users);
		$this->emailUniqueness($email, $users);

		if (count($this->errors) != 0) {
			$this->isValid = 0;
			return $this->errors;
		}
	}

	private function passwordDecryption($password)
	{
		$password = substr($password, 4);
		return $password;
	}

	private function loginsComparison($login, $users)
	{
		foreach ($users as $user) {
			if ($login === $user->login)
				return 1;
		}
	}

	private function passwordsComparison($password, $users)
	{
		foreach ($users as $user) {
			$user->password = $this->passwordDecryption($user->password);
			if (md5($password) === $user->password) {
				return 1;
			}
		}
	}

	public function authorized($login, $password, $users)
	{
		foreach ($users as $user) {
			$user->password = $this->passwordDecryption($user->password);
			if ($user->login === $login && md5($password) === $user->password)
				return 1;
		}
		// if ($this->loginsComparison($login, $users) && $this->passwordsComparison($password, $users)) {
		// 	return 1;
		// }
	}

	private function loginUniqueness($login, $users)
	{
		foreach ($users as $user) {
			if ($login === $user->login)
				$this->errors['loginError'] = 'This login already exist!';
		}
	}

	private function emailUniqueness($email, $users)
	{
		foreach ($users as $user) {
			if ($email === $user->email)
				$this->errors['emailError'] = 'This email already exist!';
		}
	}

	public function getValidValue()
	{
		return $this->isValid;
	}

	public function getErrors()
	{

		return json_encode($this->errors);
	}
}