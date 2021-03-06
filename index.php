<?php
require __DIR__ . '/vendor/autoload.php';
require 'vendor/predis/autoload.php';

Predis\Autoloader::register();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Alpacamybags\Memedb\AddMeme;
use Alpacamybags\Memedb\Repository\SQLMemeRepository;
use Alpacamybags\Memedb\Repository\RedisMemeRepository;



$app = new \Slim\App();

$container = $app->getContainer();

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('resources/templates', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};



$app->get('/', function (Request $request, Response $response) {
    $repo = new SQLMemeRepository();
    $memes = $repo->getAll();
    return $this->view->render($response,'index.html',[
        'memes' => $memes
    ]);
});

$app->get('/redistest', function (Request $request, Response $response) {
    $repo = new RedisMemeRepository();
    $memes = $repo->getAll();
    try
    {
        return $this->view->render($response,'index.html',[
            'memes' => $memes
        ]);
    }
    catch(Exception $e)
    {
        $response = $response->getBody()->write($e->getMessage());

        return $response;
    }



});

$app->get('/addmeme', function (Request $request, Response $response) {
    $response = $response->getBody()->write(file_get_contents("src/modules/addmeme.html"));
    return $response;
});

$app->post('/upload', function (Request $request, Response $response) {
    $addMeme = new AddMeme(new SQLMemeRepository());

    try
    {
        $addMeme->Add($request);

        #if we made it here, it worked
        $response = $response->withHeader('location','/');
        return $response;
    }
    catch(Exception $e)
    {
        $response = $response->getBody()->write($e->getMessage());

        return $response;
    }
});

$app->get('/memes',function (Request $request, Response $response) {
    $repo = new SQLMemeRepository();
    $test = $repo->getAll();
    $response = $response->withJson(json_encode($test));

    return $response;
});

$app->run();