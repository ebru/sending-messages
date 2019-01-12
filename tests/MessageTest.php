<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use App\Message;

final class MessageTest extends TestCase
{
    public function testSuccessful(): void
    {
        $message = new Message();

        $message->recipients  = ['31612345678'];
        $message->originator  = 'MessageBird';
        $message->body        = 'This is a test message.';

        $expected = [
            'status' => 201,
            'status_message' => "Message is sent."
        ];

        $this->assertEquals($expected, $message->send());
    }
}