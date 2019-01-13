<?php

require_once '../vendor/autoload.php';

use Controller\AuthController as Auth;
use Controller\RateLimitController;
use Controller\CreateController;

// Rate limit control
applyRateLimit();

// Authenticate the request
authenticate();

// Handle sending request to MessageBird API
function request() {
	// Get request type
	$requestMethod = $_SERVER['REQUEST_METHOD'];

	/* Request type check
	Other request types can be added to switch statement later on */
	switch($requestMethod) {
		case 'POST':
			// Get body of the POST request
			$data = json_decode(file_get_contents('php://input'), true);

			$createController = new CreateController();

			printResponse($createController->create($data));
			break;

		default:
			// Invalid request method
			header('HTTP/1.0 405 Method Not Allowed');
			break;
	}
}

// Handle the limit of requests per second
function applyRateLimit() {
	session_start();

	$rateLimitController = new RateLimitController();
	// Pass last request and current time
	$rateLimitResponse = $rateLimitController->check($_SESSION['LAST_REQUEST'], date("Y-m-d h:i:s"));

	if ($rateLimitResponse['status'] != '200') {
		printResponse($rateLimitResponse); die();
	}

	$_SESSION['LAST_REQUEST'] = date("Y-m-d h:i:s");
}

// Check the apiKey in headers
function authenticate() {
	// Get request headers
	$headers = getallheaders();

	$auth = new Auth();
	$authResponse = $auth->authenticate($headers);

	if ($authResponse['status'] == '200') {
		request();
	} else {
		printResponse($authResponse);
	}
}

// Set up the header and print JSON formatted response
function printResponse($response) {
	header('Content-type: application/json');
	header('HTTP/1.0 ' . $response['status']);
	echo json_encode($response);
}