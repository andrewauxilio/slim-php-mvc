<?php
global $app;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write($_ENV['APP_ENV']);

    return $response;
});