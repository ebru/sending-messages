<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Controller\AuthController;

final class AuthControllerTest extends TestCase
{
    public function testNoAuthorizationHeader(): void
    {
        $headers = [];
          
        $authController = new AuthController();

        $expected = [
            'status' => 401,
            'status_message' => 'Authorization key is missing.'
        ];

        $response = $authController->authenticate($headers);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }

    public function testNotValidAuthorizationKey(): void
    {
        $headers = [
            'Authorization' => 'notvalidkey'
        ];
          
        $authController = new AuthController();

        $expected = [
            'status' => 401,
            'status_message' => 'Authorization key provided is not valid.'
        ];

        $response = $authController->authenticate($headers);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }

    public function testValidAuthorizationKey(): void
    {
        $headers = [
            'Authorization' => '9fRXBgUiMjF6tnTnIm3ThqjQZ9q6GwH5'
        ];
          
        $authController = new AuthController();

        $expected = [
            'status' => 200,
            'status_message' => 'Authorization is valid.'
        ];

        $response = $authController->authenticate($headers);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }
}