<?php
use DI\Container;
use Slim\Views\Twig;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use App\Controller\IndexController;
use App\Controller\DataController;

require '../vendor/autoload.php';

$container = new Container();

$container->set(Twig::class, function() {
    return Twig::create('../src/templates', ['cache' => /**'../tmp/cache/twig'**/ false]);
});

$app = DI\Bridge\Slim\Bridge::create($container);

$app->get('/', [IndexController::class, 'mainAction']);
$app->get('/pokemon/{name}', [IndexController::class, 'pokemonAction']);
$app->get('/data', [DataController::class, 'dataAction']);

$app->run();