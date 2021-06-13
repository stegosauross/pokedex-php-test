<?php

namespace App\Controller;

use Slim\Views\Twig;
use App\Service\PokeApiService;

class IndexController
{
    private Twig $view;
    private PokeApiService $pokeApi;
 
    public function __construct(Twig $view, PokeApiService $pokeApi)
    {
        $this->view = $view;
        $this->pokeApi = $pokeApi;
    }

    public function mainAction($request, $response)
    {
        return $this->view->render($response, 'list.html.twig');
    }

    public function pokemonAction($request, $response, $name)
    {
        $pokemon = $this->pokeApi->getPokemonByName(htmlspecialchars($name));

        $viewData = [];
        
        if ($pokemon) {
            $viewData['pokemon'] = [
                "name" => $pokemon->getName(),
                "height" => $pokemon->getHeight(),
                "weight" => $pokemon->getWeight(),
                "imageUrl" => $pokemon->getImageUrl(),
                "abilities" => $pokemon->getAbilities()
            ];
        }

        return $this->view->render(
            $response,
            'pokemon.html.twig',
            $viewData
        );
    }
}