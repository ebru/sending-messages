<?php
declare(strict_types = 1);

namespace Controller;

class AuthController extends BaseController
{
    private static $clientApiKeys = [
        'user1' => '9fRXBgUiMjF6tnTnIm3ThqjQZ9q6GwH5',
        'user2' => 'rKNOfXdItLhfbGhcDFgYTDNFKitMDFZa'
    ];

    public function authenticate($headers): array {
        if (!array_key_exists('Authorization', $headers)) {
            return [
                'status' => self::RESPONSE_STATUS_UNAUTHORIZED,
                'status_message' =>'Authorization key is missing.'
            ];
        }

        $apiKey = $headers['Authorization'];

        if (!$this->validate($apiKey)) {
            return [
                'status' => self::RESPONSE_STATUS_UNAUTHORIZED,
                'status_message' =>'Authorization key provided is not valid.'
            ];
        }

        return [
            'status' => self::RESPONSE_STATUS_SUCCESS,
            'status_message' =>'Authorization is valid.'
        ];
    }
    
    public function validate($apiKey) {
        return in_array($apiKey, self::$clientApiKeys);
    }
}