<?php

namespace App\Service;

use App\Model\Pokemon;
use GuzzleHttp\Client;

/**
 * Service for making requests to PokeAPI.
 */
class PokeApiService
{
    public function getPokemonList(int $offset, int $limit) : array
    {
        $client = new Client([
            'base_uri' => $this->getPokeApiUrl()
        ]);

        $response = $client->request('GET', "pokemon?offset=$offset&limit=$limit");
        $data = json_decode($response->getBody(), true);
        $pokemon = [];
        foreach($data['results'] as $result) {
            $pokemon[] = $result['name'];
        }

        return $pokemon;
    }

    public function getPokemonByName(string $name) : ?Pokemon
    {
        $client = new Client([
            'base_uri' => $this->getPokeApiUrl(),
            'http_errors' => false //TODO: caputure exceptions and ignore 404s
        ]);

        $response = $client->request('GET', "pokemon/$name");

        if ($response->getStatusCode() === 404) {
            return null;
        }

        $data = json_decode($response->getBody(), true);
        return new Pokemon(
            $data['name'],
            $data['height'],
            $data['weight'],
            $data['sprites']['front_default'],
            array_map(function($a) { return $a['ability']['name']; }, $data['abilities'])
        );
    }

    public function getPokemonCount() : int
    {
        $client = new Client([
            'base_uri' => $this->getPokeApiUrl()
        ]);

        $response = $client->request('GET', "pokemon");
        $data = json_decode($response->getBody(), true);
        return (int)$data['count'];
    }

    private function getPokeApiUrl() : string
    {
        return 'https://pokeapi.co/api/v2/';
    }
}