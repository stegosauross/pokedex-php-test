<?php

namespace App\Controller;

use App\Service\PokeApiService;

/**
 * Used to provide paginated lists of Pokemon for the main page via Ajax requests.
 */
class DataController
{
    private PokeApiService $pokeApi;

    public function __construct(PokeApiService $pokeApi)
    {
        $this->pokeApi = $pokeApi;
    }

    public function dataAction($request, $response)
    {
        $params = $request->getQueryParams();

        $data = [];

        if (isset($params['search']['value']) && ($params['search']['value'] !== '')) {
    
            //TODO: implement check that pokemon exists, do this in a way that doesn't hit pokeAPI for every keystroke.
            
            $data = [[$params['search']['value']]];

        } else {         
            foreach ($this->pokeApi->getPokemonList($params['start'], $params['length']) as $name) {
                $data[] = [$name];
            }
        }

        $count = $this->pokeApi->getPokemonCount();

            $return = ['recordsTotal' => $count, 'recordsFiltered' => $count, 'data' => $data];
        
        $response->getBody()->write(json_encode($return));

        return $response;
    }
}