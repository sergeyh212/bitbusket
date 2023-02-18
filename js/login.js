$(document).ready(function () {
	$('form').on('submit', function (e) {

		e.preventDefault();

		let request = getData();

		fetch('/app/Controllers/UserLoginController.php',
			{
				method: 'POST',
				body: request
			})
			.then((response) => {
				return response.json();
			})
			.then((data) => {
				errors(data);
				authorized(data);
			});
	});
});

function getData() {
	let login = document.getElementById('login').value;
	let password = document.getElementById('password').value;

	let data = new FormData()
	data.append('login', login);
	data.append('password', password);

	return data;
};

function errors(errors) {

	if (errors['loginError'] != null || errors['passwordError'] != null)
		document.getElementById('errors').innerHTML = 'Неправильный логин или пароль!';
	else
		document.getElementById('errors').innerHTML = ' ';
};

function authorized(data) {
	if (data['authorized'] === 'true') {
		console.log('You have seccessfuly authorized');
		document.getElementById('form').hidden = true;

		const cookie = document.cookie.split(';');
		document.getElementById('user').innerHTML = 'Hello ' + cookie[0];
	}
}