<?php

class UserRequest
{

	private $errors = [];
	private $isValid = 1;

	public function validation($login, $password, $confirmPassword, $email, $name)
	{
		$regexLogin = '/^[^\s]+$/';
		$regexPassword = '/^(?=.*[a-za-яё])(?=.*[0-9])[^\\/,.~!@#$%^&*\\\()<>|\'\"{}\-=;:№?`_+\][^\s]+$/i';
		$regexName = '/(^[a-za-яё]+$)/i';

		$path = $_SERVER['DOCUMENT_ROOT'] . '/database/UserDatabase.json';
		$users = json_decode(file_get_contents($path, true))->users;

		if (!preg_match($regexLogin, $login) || strlen($login) < 6)
			$this->errors['loginError'] = 'Недопустимый логин!';

		if (!preg_match($regexPassword, $password ?? '') || strlen($password) < 6)
			$this->errors['passwordError'] = 'Недопустимый пароль!';

		if ($confirmPassword !== $password || $confirmPassword == '') {
			$this->errors['confirmPasswordError'] = 'Пароли не соответствуют!';
		}

		if (!preg_match($regexName, $name) || strlen($name) < 2)
			$this->errors['nameError'] = 'Недопустимое имя!';

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
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

	public function authorized($login, $password, $users)
	{
		foreach ($users as $user) {
			$user->password = $this->passwordDecryption($user->password);
			if ($user->login === $login && md5($password) === $user->password)
				return 1;
		}
	}

	private function loginUniqueness($login, $users)
	{
		foreach ($users as $user) {
			if ($login === $user->login)
				$this->errors['loginError'] = 'Этот логин уже занят!';
		}
	}

	private function emailUniqueness($email, $users)
	{
		foreach ($users as $user) {
			if ($email === $user->email)
				$this->errors['emailError'] = 'Этот email уже занят!';
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
