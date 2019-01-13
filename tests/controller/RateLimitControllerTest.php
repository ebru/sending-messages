<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Controller\RateLimitController;

final class RateLimitControllerTest extends TestCase
{
    public function testRequestLimitExceeded(): void
    {
        $lastRequest = '2019-01-13 02:51:57';
        $currentTime = '2019-01-13 02:51:57';

        $rateLimitController = new rateLimitController();

        $expected = [
            'status' => 400,
            'status_message' => 'Request limit exceeded.'
        ];

        $response = $rateLimitController->check($lastRequest, $currentTime);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }

    public function testRequestLimitNotExceeded(): void
    {
        $lastRequest = '2019-01-13 02:51:57';
        $currentTime = '2019-01-13 02:54:57';

        $rateLimitController = new rateLimitController();

        $expected = [
            'status' => 200,
            'status_message' => 'Request limit not exceeded yet.'
        ];

        $response = $rateLimitController->check($lastRequest, $currentTime);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }
}