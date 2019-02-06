<?php
declare(strict_types = 1);

namespace Model;

class Base 
{
    protected $client;
    protected $configs;

    const RESPONSE_STATUS_SUCCESS = 200;
    const RESPONSE_STATUS_BAD_REQUEST = 400;
    const RESPONSE_STATUS_UNAUTHORIZED = 401;
    const RESPONSE_STATUS_GENERAL = 500;

    public function __construct() {
        $this->configs = include(__DIR__ . '/../../config/config.php');

        // Connect to MessageBird
        $this->client = new \MessageBird\Client($this->configs['clientApiKey']);
    }
}