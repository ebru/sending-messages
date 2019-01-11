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

        $expected = json_decode('{"direction":"mt","type":"sms","originator":"MessageBird","body":"This is a test message.","reference":null,"validity":null,"gateway":10,"typeDetails":{},"datacoding":"plain","mclass":1,"scheduledDatetime":null,"recipients":{"totalCount":1,"totalSentCount":1,"totalDeliveredCount":0,"totalDeliveryFailedCount":0,"items":[{"recipient":31612345678,"status":"sent","statusDatetime":"2019-01-11T18:07:15+00:00"}]},"reportUrl":null}', true);
        $result   = json_decode($message->send(), true);

        $this->assertEquals($expected['originator'], $result['originator']);
        $this->assertEquals($expected['recipients']['items']['recipient'], $result['recipients']['items']['recipient']);
        $this->assertEquals($expected['body'], $result['body']);
        $this->assertEquals($expected['recipients']['items']['status'], $result['recipients']['items']['status']);
    }
}