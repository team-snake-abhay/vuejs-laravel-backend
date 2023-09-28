<?php

namespace App\Services\DeepGram;

use GuzzleHttp\Client;

class DeepGramConverter
{
    /**
     * Guzzle HTTP client
     *
     * @var Client
     */
    private $client;

      
        
    public function __construct()
    {        
        $this->client = new Client([
            'base_uri' => config('services.deepgram.base_uri'),           
            'http_errors' => false,
        ]);
    }

    /**
     * Parse the response
     *
     * @param string $audio_url
     *
     * @return json
     */
    public static function convert(string $audio_url) //: array
    {
        $obj = new DeepGramConverter();

        $response = $obj->client->post('', [
            'body' => '{"url":"'.$audio_url.'"}',
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => config('services.deepgram.token'),
            ],
        ]);

        $body = $response->getBody()->getContents();
        return json_decode($body,true);
    }
    
}