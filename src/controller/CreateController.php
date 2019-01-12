<?php
declare(strict_types = 1);

namespace Controller;

use Model\Message;

class CreateController extends BaseController
{
    public function create($data): array
    {
        // Create new message
        $message = new Message();

        // Validate the request data
        $validationResponse = $this->validateRequest($data);

        if (!empty($validationResponse)) {
            return $validationResponse;
        }

        // Set up the message
        $message->recipients = $data['recipient'];
        $message->originator = $data['originator'];
        $message->body       = $data['message'];

        return $message->send();
    }

    public function validateRequest(array $data) {
        if (empty($data['recipient'])) {
            return [
				'status' => self::RESPONSE_STATUS_BAD_REQUEST,
				'status_message' =>'Recipient field cannot be empty.'
            ];
        }

        if (empty($data['originator'])) {
            return [
				'status' => self::RESPONSE_STATUS_BAD_REQUEST,
				'status_message' =>'Originator field cannot be empty.'
            ];
        }

        if (strlen($data['message']) > 160) {
            return [
				'status' => self::RESPONSE_STATUS_BAD_REQUEST,
				'status_message' =>'Message text cannot be longer than 160.'
            ];
        }
    }
}