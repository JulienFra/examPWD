<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('OPENAI_BASE_URL');
        $this->apiKey = config('OPENAI_API_KEY');
    }


    public function paraphrase($text)
    {
        $response = $this->client->request('POST', $this->baseUrl . '/paraphrase', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => $text,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true)['paraphrase'];
    }
}
