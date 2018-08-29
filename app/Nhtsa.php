<?php

namespace App;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

/**
 * API Wrapper for Nhtsa JSON API 
 * https://one.nhtsa.gov/webapi/Default.aspx?SafetyRatings/API/5
 */

class Nhtsa
{

    protected $client;
    protected $apiEndPoint = 'https://one.nhtsa.gov/webapi/api';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function api($url, $params = [])
    {
        $url = $this->apiEndPoint . $url;
        try {
            return json_decode($this->client->get($url)->getBody());
        } catch (\Exception $e) {
            return false;
        }
    }

    public function output($results)
    {
        return [
            "Count" => count($results),
            "Results" => $results
        ];
    }
}
