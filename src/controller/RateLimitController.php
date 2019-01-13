<?php
declare(strict_types = 1);

namespace Controller;

class RateLimitController extends BaseController
{
    public function check($lastRequest): array {
        if (isset($lastRequest)) {
            $last = strtotime($lastRequest);
            $current = strtotime(date("Y-m-d h:i:s"));
            $time = abs($last - $current);

            if ($time <= 1) {
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