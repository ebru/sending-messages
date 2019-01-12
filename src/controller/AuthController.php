<?php
declare(strict_types = 1);

namespace Controller;

class AuthController
{
    private static $clientApiKeys = [
        'user1' => '9fRXBgUiMjF6tnTnIm3ThqjQZ9q6GwH5',
        'user2' => 'rKNOfXdItLhfbGhcDFgYTDNFKitMDFZa'
    ];

    const RESPONSE_STATUS_SUCCESS = 200;
    const RESPONSE_STATUS_UNAUTHORIZED = 401;

    public function authenticate($headers): array {
        if (!$headers['Authorization']) {
            $response = [
                'status' => self::RESPONSE_STATUS_UNAUTHORIZED,
                'status_message' =>'Authorization key is missing.'
            ];

            return $response;
        }

        $apiKey = $headers['Authorization'];

        if (!$this->validate($apiKey)) {
            $response = [
                'status' => self::RESPONSE_STATUS_UNAUTHORIZED,
                'status_message' =>'Authorization key provided is not valid.'
            ];

            return $response;
        }

        $response = [
            'status' => self::RESPONSE_STATUS_SUCCESS,
            'status_message' =>'Authorization is valid.'
        ];

        return $response;
    }
    
    public function validate($apiKey) {
        return in_array($apiKey, self::$clientApiKeys);
    }
}