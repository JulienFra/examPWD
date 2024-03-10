<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class OpenAIController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function testAPI()
    {
        $response = $this->client->request('GET', 'files', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return response()->json($data);
    }
}
