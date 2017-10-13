<?php
require __DIR__ . '/vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Alpacamybags\Memedb\Meme;
use Alpacamybags\Memedb\AddMeme;
use Alpacamybags\Memedb\Repository\SQLMemeRepository;



$app = new \Slim\App();

$app->get('/', function (Request $request, Response $response) {
    $response = $response->getBody()->write(file_get_contents("public/index.html"));
    return $response;
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
        $response = $response->withStatus('500',$e->getMessage());
        $response = $response->getBody()->write($e->getMessage());

        return $response;
    }
});

/*$app->get('/memes',function (Request $request, Response $response) {
    $repo = SQLMemeRepository();
    $test = $repo->getAll();
    $testtwo = array("test","test2");
    $response = $response->withBody(implode(",",$testtwo));

    return $response;
});*/

$app->run();