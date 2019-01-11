<?php
header('Content-Type: application/json');

require_once __DIR__ . '/vendor/autoload.php';

use App\Message;

$message = new Message();

$message->recipients  = ['31612345678'];
$message->originator  = 'MessageBird';
$message->body        = 'This is a test message.';

echo $message->send();