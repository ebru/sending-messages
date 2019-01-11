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
        return "Recipient: " . $this->recipient . " , Originator: " . $this->originator . " , Message: " . $this->messageBody;
    }
}