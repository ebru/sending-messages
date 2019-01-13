<?php
declare(strict_types = 1);

namespace Controller;

class RateLimitController extends BaseController
{
    public function check($lastRequest): array {
        if (isset($lastRequest)) {
            $last = strtotime($lastRequest);
            $curr = strtotime(date("Y-m-d h:i:s"));
            $sec =  abs($last - $curr);

            if ($sec <= 3) {
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