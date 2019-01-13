<?php
declare(strict_types = 1);

namespace Controller;

use Model\Date;

class RateLimitController extends BaseController
{
    public function check($lastRequest, $currentTime): array {
        if (isset($lastRequest)) {
            $last = strtotime($lastRequest);
            $current = strtotime($currentTime);
            
            $diff = abs($last - $current);

            if ($diff <= 1) {
                return [
                    'status' => self::RESPONSE_STATUS_BAD_REQUEST,
                    'status_message' =>'Request limit exceeded.'
                ];
            }
        }
        
        return [
            'status' => self::RESPONSE_STATUS_SUCCESS,
            'status_message' =>'Request limit not exceeded yet.'
        ];
    }
}