<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

include('repository/SQLMemeRepository.php');

$app = new \Slim\App();

$app->get('/memes',function (Request $request, Response $response) {
    $repo = new SQLMemeRepository();
    $response = $repo->getAll();

    return $response;
});

$app->run();