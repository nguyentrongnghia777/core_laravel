<?php

namespace App\Http\Helpers;

Class ResponseHelper {
    /*
        {
            "meta": {
                 "error_type": "OAuthException",
                 "code": 400,
                 "error_message": "..."
            },
            "data": {
                 ...
                "pagination": {
                     "next_url": "...",
                     "next_max_id": "13872296"
                }
            },
        }
    */

    // error type
    const NOT_FOUND = 'NOT_FOUND';

    /**
     * convert response success for api
     * @param object $data
     * @param int $status_code
     * @return json object
     */
    public static function success($data = null, $status_code) {
        return response(json_encode([
            'data' => $data,
        ]), $status_code)->header('Content-Type', 'application/json');
    }

    /**
     * convert response error for api
     * @param string $error_type
     * @param array $error_message
     * @param int $status_code
     * @return json object
     */
    public static function error($error_type = NOT_FOUND, $error_message = [], $status_code) {
        return response(json_encode([
            'meta' => (object) [
                "error_type" => $error_type,
                "error_message" => $error_message,
            ],
        ]), $status_code)->header('Content-Type', 'application/json');
    }
}