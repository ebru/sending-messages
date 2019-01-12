<?php
declare(strict_types = 1);

namespace Model;

class Message 
{
    public $client;
    public $recipients;
    public $originator;
    public $body;

    const RESPONSE_STATUS_SUCCESS = 200;
    const RESPONSE_STATUS_BAD_REQUEST = 400;
    const RESPONSE_STATUS_UNAUTHORIZED = 401;
    const RESPONSE_STATUS_GENERAL = 500;

    public function __construct() {
        $this->client = new \MessageBird\Client('lG7WMSfYQkXM9LImklLsK107L');
    }

    // Send create request to MessageBird API
    public function send(): array
    {
        $message             = new \MessageBird\Objects\Message();
        $message->originator = $this->originator;
        $message->recipients = $this->recipients;
        $message->body       = $this->body;

        try {
            $messageResult = $this->client->messages->create($message);
            
            $response = [
				'status' => self::RESPONSE_STATUS_SUCCESS,
				'status_message' =>'Message is sent.'
            ];

        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            $response = [
				'status' => self::RESPONSE_STATUS_UNAUTHORIZED,
				'status_message' =>'Authorization key for MessageBird is not valid.',
            ];

        } catch (\MessageBird\Exceptions\BalanceException $e) {
            $response = [
				'status' => self::RESPONSE_STATUS_BAD_REQUEST,
				'status_message' =>'Out of balance on MessageBird.'
            ];

        } catch (\Exception $e) {
            $response = [
				'status' => self::RESPONSE_STATUS_GENERAL,
				'status_message' => $e->getMessage()
            ];
        }

        return $response;
    }
}