<?php
declare(strict_types = 1);

namespace App;

class Message 
{
    public $client;
    public $recipients;
    public $originator;
    public $body;

    public function __construct() {
        $this->client = new \MessageBird\Client('lG7WMSfYQkXM9LImklLsK107L');
    }

    public function send(): string
    {
        $message             = new \MessageBird\Objects\Message();
        $message->originator = $this->originator;
        $message->recipients = $this->recipients;
        $message->body       = $this->body;

        try {
            $messageResult = $this->client->messages->create($message);
            return json_encode($messageResult);

        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            // That means that your accessKey is unknown
            return 'wrong login';

        } catch (\MessageBird\Exceptions\BalanceException $e) {
            // That means that you are out of credits, so do something about it.
            return 'no balance';

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}