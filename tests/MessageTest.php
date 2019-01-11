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

        $this->assertEquals('Recipient: Test9054545 , Originator: TestOriginator , Message: Loremipsumdolorsitamet', $message->send());
    }
}