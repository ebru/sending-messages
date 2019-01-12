<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

use Controller\CreateController;

final class CreateControllerTest extends TestCase
{
    public function testSuccessful(): void
    {
        $createController = new CreateController();

        $this->assertTrue(true);
    }
}