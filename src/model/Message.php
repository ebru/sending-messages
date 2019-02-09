<?php
declare(strict_types = 1);

namespace Model;

class Message extends Base
{
    public $recipients;
    public $originator;
    public $body;

    private $client;
    private $clientApiKey;

    public function __construct($clientApiKey) {
        $this->clientApiKey = $clientApiKey;
    }

    public function createClient() {
        return new \MessageBird\Client($this->clientApiKey);
    }

    // Send create request to MessageBird API
    public function send(): array
    {
        $message             = new \MessageBird\Objects\Message();
        $message->originator = $this->originator;
        $message->recipients = $this->recipients;
        $message->body       = $this->body;

        try {
            $this->client = $this->createClient();

            $messageResult = $this->client->messages->create($message);
            
            $response = [
				'status' => self::RESPONSE_STATUS_SUCCESS,
                'status_message' =>'Message is sent.',
                'details' => json_decode(json_encode($messageResult), true) // Convert object to array
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