<?php
require_once __DIR__ . '/vendor/autoload.php';

use Controller\CreateController;

$requestMethod = $_SERVER["REQUEST_METHOD"];

/* Request type check
Other request types can be added to switch statement */
switch($requestMethod)
	{
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