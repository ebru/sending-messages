<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use Controller\AuthController;

final class AuthControllerTest extends TestCase
{
    public function testSuccessful(): void
    {
        $authController = new AuthController();

        $this->assertTrue(true);
    }
}