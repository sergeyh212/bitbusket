authorization();

function authorization(exit = 0) {
	let request = getExit(exit);
	console.log(request);
	fetch('/app/Controllers/AuthorizationController.php',
		{
			method: 'POST',
			body: request
		}
	)
		.then((response) => {
			return response.json();
		})
		.then((data) => {
			console.log(data);
			if (data['authorized'] == 'false')
				authorized(data);
		});
}

function authorized(data) {
	if (data['authorized'] === 'true') {
		console.log('You have seccessfuly authorized');
		document.getElementById('form').hidden = true;
		document.getElementById('exit').hidden = false;

		document.getElementById('user').innerHTML = 'Hello, ' + data['login'];
	}
}

exitHandler = () => {
	document.getElementById('form').hidden = false;
	document.getElementById('exit').hidden = true;

	document.getElementById('user').innerHTML = ' ';

	authorization(1);
}

function getExit(exit) {
	let data = new FormData()

	if (exit) {
		data.append('exit', 'true');
	}
	else {
		data.append('exit', 'false');
	}

	return data;
}