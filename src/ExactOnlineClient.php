<?php

namespace Yource\ExactOnlineClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ExactOnlineClient
{
    private $client;

    /**
     * The endpoint of the resource.
     */
    private $endpoint;

    /**
     * The query.
     */
    public $query = [];

    public function __construct(string $endpoint)
    {
        dd(1);
        $this->client = new Client([
            'base_uri' => config('navitia-client-laravel.base_uri')
        ]);

        $this->endpoint = $endpoint;
    }

    /**
     * Make a Navatia GET request
     */
    public function get()
    {
        try {
            $response = $this->client->request('GET', $this->endpoint, [
                'headers' => [
                    'Authorization' => config('navitia-client-laravel.api_key')
                ],
                'query' => $this->query
            ]);
        } catch (GuzzleException $exception){
            dd($exception);
        }

        return $response;
    }

    /**
     * Return the resource(s) as an array
     */
    public function toArray()
    {
        return json_decode($this->get()->getBody()->getContents());
    }

    public function where(string $field, $value)
    {
        $this->query[$field] = $value;

        return $this;
    }
}
