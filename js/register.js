$(document).ready(function () {
	$('form').on('submit', function (e) {

		e.preventDefault();

		let request = getData();

		fetch('/app/Controllers/UserRegisterController.php',
			{
				method: 'POST',
				body: request
			})
			.then((response) => {
				return response.json();
			})
			.then((data) => {
				registered(data);

				errors(data);
			});
	});
});


function getData() {
	let login = document.getElementById('login').value;
	let password = document.getElementById('password').value;
	let confirmPassword = document.getElementById('confirm_password').value;
	let email = document.getElementById('email').value;
	let name = document.getElementById('name').value;

	let data = new FormData()
	data.append('login', login);
	data.append('password', password);
	data.append('confirm_password', confirmPassword);
	data.append('email', email);
	data.append('name', name);

	return data;
};

function errors(errors) {

	if (errors['loginError'] != null)
		document.getElementById('login_error').innerHTML = errors['loginError'];
	else
		document.getElementById('login_error').innerHTML = ' ';

	if (errors['passwordError'] != null)
		document.getElementById('password_error').innerHTML = errors['passwordError'];
	else
		document.getElementById('password_error').innerHTML = ' ';

	if (errors['confirmPasswordError'] != null)
		document.getElementById('confirm_password_error').innerHTML = errors['confirmPasswordError'];
	else
		document.getElementById('confirm_password_error').innerHTML = ' ';

	if (errors['emailError'] != null)
		document.getElementById('email_error').innerHTML = errors['emailError'];
	else
		document.getElementById('email_error').innerHTML = ' ';

	if (errors['nameError'] != null)
		document.getElementById('name_error').innerHTML = errors['nameError'];
	else
		document.getElementById('name_error').innerHTML = ' ';

};

function registered(data) {
	if (data['registered'] === 'true')
		console.log('You have seccessfuly registered');
}