<?php
declare(strict_types = 1);

namespace App;

class Message 
{
    public $recipient;
    public $originator;
    public $messageBody;

    public function send(): string
    {
        $messageArr = [
            'recipient' => $this->recipient,
            'originator' => $this->originator,
            'message' => $this->messageBody
        ];

        return json_encode($messageArr);
    }
}