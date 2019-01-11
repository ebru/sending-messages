<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Message;

$message = new Message();

$message->recipient = "Test9054545";
$message->originator = "TestOriginator";
$message->messageBody = "Loremipsumdolorsitamet";

echo $message->send();