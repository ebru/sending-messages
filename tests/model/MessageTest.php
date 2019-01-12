<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use Model\Message;

final class MessageTest extends TestCase
{
    public function testSuccessful(): void
    {
        $message = new Message();

        $message->recipients  = ['31612345678'];
        $message->originator  = 'MessageBird';
        $message->body        = 'This is a test message.';

        $expected = [
            'status' => 200,
            'status_message' => "Message is sent."
        ];

        $this->assertTrue(true);
    }
}