<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use App\Message;

final class MessageTest extends TestCase
{
    public function testSuccessful(): void
    {
        $message = new Message();

        $message->recipient = "Test9054545";
        $message->originator = "TestOriginator";
        $message->messageBody = "Loremipsumdolorsitamet";

        $messageJson = '{"recipient":"Test9054545","originator":"TestOriginator","message":"Loremipsumdolorsitamet"}';

        $this->assertEquals($messageJson, $message->send());
    }
}