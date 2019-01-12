<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controller\AuthController as Auth;
use Controller\CreateController;

authenticate();

function request() {
	// Get request type
	$requestMethod = $_SERVER["REQUEST_METHOD"];

	/* Request type check
	Other request types can be added to switch statement later on */
	switch($requestMethod) {
		case 'POST':
			// Get body of the POST request
			$data = json_decode(file_get_contents('php://input'), true);

			$createController = new CreateController();

			header('Content-Type: application/json');
			echo json_encode($createController->create($data));
			break;

		default:
			// Invalid request method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}
}

function authenticate() {
	// Get request headers
	$headers = getallheaders();

	$auth = new Auth();
	$authResponse = $auth->authenticate($headers);

	if ($authResponse['status'] == '200') {
		request();
	} else {
		header('Content-Type: application/json');
		echo json_encode($authResponse);
	}
}