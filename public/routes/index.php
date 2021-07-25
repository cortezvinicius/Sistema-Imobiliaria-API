<?php
use Slim\App;
use Tuupola\Middleware\CorsMiddleware;
use vcinsidedigital\Controllers\Imovel;
use vcinsidedigital\MiddleWares\Middlewares;

use function src\SlimConfiguration;


$app = new App(SlimConfiguration());

$app->add(new CorsMiddleware([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => ["Accept", "Content-Type"],
    "headers.expose" => [],
    "credentials" => 'same-origin',
]));


$app->get('/', function()
{

});

$app->group('/imoveis', function() use($app)
{
    $app->get('/{type}/{token}/listAllImoveis/{status}', Imovel::class. ':listAllImoveis')->add(MiddleWares::verefyToken());
    $app->get('/{type}/{token}/listAllImoveisDestaque/{status}', Imovel::class. ':listAllImoveisDestaque')->add(Middlewares::verefyToken());
});

$app->run();