<?php

namespace TimelineAPI;

use Exception;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Pin.php';

class Timeline {

    private static $TIMELINE_API = 'https://timeline-api.getpebble.com';
    private static $USER_PIN_API = '/v1/user/pins/';
    private static $USER_SUBSCRIPTION_API = '/v1/user/subscriptions/';
    private static $SHARED_PIN_API = '/v1/shared/pins/';


    private static $ERROR_CODES = [200 => 'Success!', 400 => 'The pin object submitted was invalid.', 403 => 'The API key submitted was invalid.', 410 => 'The user token submitted was invalid or does not exist.', 429 => 'Server is sending updates too quickly.', 503 => 'Could not save pin due to a temporary server error.'];


    static function pushPin($userToken, Pin $pin) {
        if (!is_string($userToken)) {
            throw new Exception('Usertoken not of type string');
        }

        if ($pin == null) {
            throw new Exception('Pin id cannot be null');
        }

        $id = $pin->getID();
        if ($id == null) {
            throw new Exception('Pin id cannot be null');
        }

        $headers = ['Content-Type: application/json', 'X-User-Token: ' . $userToken];
        $requestURL = self::$TIMELINE_API . self::$USER_PIN_API . $id;

        return self::sendRequest($requestURL, 'PUT', $headers, $pin->getData());
    }

    static function pushRawPin($userToken, $pin) {
        if (!is_string($userToken)) {
            throw new Exception('Usertoken not of type string');
        }

        if (!is_string($pin)) {
            throw new Exception('Raw data must be a pin');
        }

        $pinObject = json_decode($pin, true);

        $headers = ['Content-Type: application/json', 'X-User-Token: ' . $userToken];
        $requestURL = self::$TIMELINE_API . self::$USER_PIN_API . $pinObject['id'];

        return self::sendRequest($requestURL, 'PUT', $headers, $pinObject);
    }

    static function pushSharedPin($key, Array $topics, Pin $pin) {
        if ($key == null || $key === '') {
            throw new Exception('Timeline API key invalid');
        }
        if ($pin == null) {
            throw new Exception('Pin id cannot be null');
        }
        $id = $pin->getID();

        if ($id == null) {
            throw new Exception('Pin id cannot be null');
        }

        $headers = ['Content-Type: application/json', 'X-API-Key: ' . $key, 'X-Pin-Topics:' . join(',', $topics)];
        $requestURL = self::$TIMELINE_API . self::$SHARED_PIN_API . $id;

        return self::sendRequest($requestURL, 'PUT', $headers, $pin->getData());
    }

    static function deletePin($userToken, $id) {
        if (!is_string($userToken)) {
            throw new Exception('Usertoken not of type string');
        }

        if ($id == null) {
            throw new Exception('Pin id cannot be null');
        }

        $headers = ['Content-Type: application/json', 'X-User-Token: ' . $userToken];
        $requestURL = self::$TIMELINE_API . self::$USER_PIN_API . $id;

        return self::sendRequest($requestURL, 'DELETE', $headers);
    }

    static function deleteSharedPin($key, $id) {
        if (!is_string($key)) {
            throw new Exception('API Key not of type string');
        }

        $headers = ['Content-Type: application/json', 'X-API-Key: ' . $key];
        $requestURL = self::$TIMELINE_API . self::$SHARED_PIN_API . $id;

        return self::sendRequest($requestURL, 'DELETE', $headers);
    }

    static function listSubscriptions($userToken) {
        if (!is_string($userToken)) {
            throw new Exception('Usertoken not of type string');
        }

        $headers = ['Content-Type: application/json', 'X-User-Token: ' . $userToken];
        $requestURL = self::$TIMELINE_API . self::$USER_SUBSCRIPTION_API;

        return self::sendRequest($requestURL, 'GET', $headers);
    }

    private static function sendRequest($url, $method, Array $headers, $postData = null) {

        $ch = curl_init();
        curl_setopt_array($ch, [CURLOPT_CUSTOMREQUEST => $method, CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => $headers, CURLOPT_POSTFIELDS => json_encode($postData), CURLOPT_URL => $url, CURLOPT_SSL_VERIFYPEER => false]);
        $response = curl_exec($ch);

        $RESPONSE_CODE = curl_getinfo($ch)['http_code'];
        $RESPONSE_STATUS = ($RESPONSE_CODE != null && array_key_exists($RESPONSE_CODE, self::$ERROR_CODES)) ? self::$ERROR_CODES[$RESPONSE_CODE] : 'Illegal response code.';

        curl_close($ch);

        if ($response === false) {
            die(curl_error($ch));
        }

        return ['status' => ['code' => $RESPONSE_CODE, 'message' => $RESPONSE_STATUS], 'result' => json_decode($response, true)];
    }

}

?>