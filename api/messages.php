<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Message;

$requestMethod = $_SERVER["REQUEST_METHOD"];

/* Request type check
Other request types can be added to switch statement */
switch($requestMethod)
	{
        case 'POST':
			// Get body of the POST request
			$data = json_decode(file_get_contents('php://input'), true);

			// Create new message
			$message = new Message();

			$message->recipients  = $data['recipient'];
			$message->originator  = $data['originator'];
			$message->body        = $data['message'];

			header('Content-Type: application/json');
			echo json_encode($message->send());
			break;
		default:
			// Invalid request method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}