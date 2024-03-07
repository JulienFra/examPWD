<?php

namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


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
        try {
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
        } catch (RequestException $e) {
            // Gérer les erreurs de requête ici
            // Vous pouvez accéder aux informations sur l'erreur en utilisant $e->getMessage(), $e->getCode(), etc.
            return 'Erreur: ' . $e->getMessage();
        }
    }
}
