<?php
declare(strict_types = 1);

namespace Controller;

use Model\Message;

class CreateController 
{
    public function create($data): array
    {
        // Create new message
        $message = new Message();

        $message->recipients  = $data['recipient'];
        $message->originator  = $data['originator'];
        $message->body        = $data['message'];

        return $message->send();
    }
}