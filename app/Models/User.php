<?php

include('../Requests/UserRequest.php');

class User
{

	private $login;
	private $password;
	private $confirm_password;
	private $email;
	private $name;
	private $isValid;
	private $authorized = 0;
	private $errors;

	public function __construct($login, $password, $confirm_password, $email, $name)
	{
		$this->login = $login;
		$this->password = $password;
		$this->confirm_password = $confirm_password;
		$this->email = $email;
		$this->name = $name;

		$request = new UserRequest();
		if ($request->authorized($this->login, $this->password, $this->getJson()->users)) {
			$this->authorized = 1;
		}

		$request->validation($this->login, $this->password, $this->confirm_password, $this->email, $this->name);
		$this->errors = $request->getErrors();

		$this->isValid = $request->getValidValue();
	}

	private static function getJson()
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . '/database/UserDatabase.json';
		$json = json_decode(file_get_contents($path, true));

		return $json;
	}

	public static function create(User $user)
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . '/database/UserDatabase.json';
		$password = self::passwordEncrypting($user->password);
		$id = self::getId();
		$jsonUsers = self::getJson();

		$json = [
			'id' =>  $id,
			'login' => $user->login,
			'password' => $password,
			'email' => $user->email,
			'name' => $user->name
		];

		array_push($jsonUsers->users, $json);
		$jsonUsers = json_encode($jsonUsers);
		file_put_contents($path, $jsonUsers);
	}

	private static function getId()
	{
		$json = self::getJson();
		$userLength = count($json->users);
		$id = $json->users == null ? 1 : $json->users[$userLength - 1]->id + 1;

		return $id;
	}

	private static function passwordEncrypting($password)
	{
		$salt = rand(1000, 9999);
		$password = $salt . md5($password);

		return $password;
	}

	public function isValid()
	{
		return $this->isValid;
	}

	public function authorized()
	{
		return $this->authorized;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}