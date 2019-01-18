<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Model\Message;

final class MessageTest extends TestCase
{
    public function testMessageCreated(): void
    {
        $message = new Message();

        $message->recipients  = '31612345678';
        $message->originator  = 'MessageBird';
        $message->body        = 'This is a test message.';
        
        $expected = [
            'status' => 200,
            'status_message' => 'Message is sent.',
            'details' => [
                'type' => 'sms',
                'originator' => 'MessageBird',
                'body' => 'This is a test message.',
                'recipients' => [
                    'items' => [
                        'recipient' => 31612345678,
                        'status' => 'sent'
                    ]
                ]
            ]
        ];

        $response = $message->send();

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
        $this->assertEquals($expected['details']['type'], $response['details']['type']);
        $this->assertEquals($expected['details']['originator'], $response['details']['originator']);
        $this->assertEquals($expected['details']['body'], $response['details']['body']);
        $this->assertEquals($expected['details']['recipients'][0]['items']['recipient'], $response['details']['recipients'][0]['items']['recipient']);
        $this->assertEquals($expected['details']['recipients'][0]['items']['status'], $response['details']['recipients'][0]['items']['status']);
    }
}