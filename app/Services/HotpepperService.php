<?php

namespace App\Services;

use GuzzleHttp\Client;

class HotpepperService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('HOTPEPPER_API_KEY');
    }

    public function searchRestaurants($params)
    {
        $response = $this->client->get('https://webservice.recruit.co.jp/hotpepper/gourmet/v1/', [
            'query' => array_merge($params, ['key' => $this->apiKey, 'format' => 'json'])
        ]);

        return json_decode($response->getBody(), true);
    }
}
