<?php


namespace App\services;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class ManageApiServices
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function accueil():array{
        $response = $this->client->request(
            'GET',
            'https://algrobk.herokuapp.com/accueils'
        );

        return $response ->toArray();
    }

    public function temoignages():array{
        $response = $this->client->request(
            'GET',
            'https://algrobk.herokuapp.com/temoignages'
        );

        return $response ->toArray();
    }
}