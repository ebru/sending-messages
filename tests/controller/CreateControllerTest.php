<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Controller\CreateController;

final class CreateControllerTest extends TestCase
{
    public function testEmptyRecipientField(): void
    {
        $data = [
            'recipient' => '',
            'originator' => 'MessageBird',
            'message' => 'This is a test message.'
        ];
          
        $createController = new CreateController();

        $expected = [
            'status' => 400,
            'status_message' => 'Recipient field cannot be empty.'
        ];

        $response = $createController->create($data);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }

    public function testEmptyOriginatorField(): void
    {
        $data = [
            'recipient' => '31612345678',
            'originator' => '',
            'message' => 'This is a test message.'
        ];
          
        $createController = new CreateController();

        $expected = [
            'status' => 400,
            'status_message' => 'Originator field cannot be empty.'
        ];

        $response = $createController->create($data);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }

    public function testEmptyMessageField(): void
    {
        $data = [
            'recipient' => '31612345678',
            'originator' => 'MessageBird',
            'message' => ''
        ];
          
        $createController = new CreateController();

        $expected = [
            'status' => 400,
            'status_message' => 'Message field cannot be empty.'
        ];

        $response = $createController->create($data);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }

    public function testMessageLongerThan160Characters(): void
    {
        $data = [
            'recipient' => '31612345678',
            'originator' => 'MessageBird',
            'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ex purus, eleifend nec neque a, 
                          volutpat facilisis metus. Duis sit amet massa aliquet, imperdiet turpis a, consequat est. 
                          Donec non nibh magna. Duis sed sapien porta, sodales nisi nec, tincidunt velit. In nisi diam, dictum vel enim eget, 
                          vestibulum semper tortor.'
        ];
          
        $createController = new CreateController();

        $expected = [
            'status' => 400,
            'status_message' => 'Message text cannot be longer than 160 characters.'
        ];

        $response = $createController->create($data);

        $this->assertEquals($expected['status'], $response['status']);
        $this->assertEquals($expected['status_message'], $response['status_message']);
    }
}