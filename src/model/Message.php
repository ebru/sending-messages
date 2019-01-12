<?php
declare(strict_types = 1);

namespace Model;

class Message 
{
    public $client;
    public $recipients;
    public $originator;
    public $body;

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
				'status' => 201,
				'status_message' =>'Message is sent.'
            ];

        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            $response = [
				'status' => 400,
				'status_message' =>'Authorization key is not valid.',
            ];

        } catch (\MessageBird\Exceptions\BalanceException $e) {
            $response = [
				'status' => 400,
				'status_message' =>'Out of balance.'
            ];

        } catch (\Exception $e) {
            $response = [
				'status' => 500,
				'status_message' => $e->getMessage()
            ];
        }

        return $response;
    }
}