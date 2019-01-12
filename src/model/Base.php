<?php
declare(strict_types = 1);

namespace Model;

class Base 
{
    protected $client;
    const CLIENT_API_KEY = 'lG7WMSfYQkXM9LImklLsK107L';

    const RESPONSE_STATUS_SUCCESS = 200;
    const RESPONSE_STATUS_BAD_REQUEST = 400;
    const RESPONSE_STATUS_UNAUTHORIZED = 401;
    const RESPONSE_STATUS_GENERAL = 500;

    public function __construct() {
        // Connect to MessageBird
        $this->client = new \MessageBird\Client(self::CLIENT_API_KEY);
    }
}