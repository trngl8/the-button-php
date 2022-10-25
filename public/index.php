<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Core\Router;

$request = Request::createFromGlobals();

$path = $request->getPathInfo();

$router = new Router($request);

$router->get('/', function(Request $request, Response $response) {
    $response->setContent('Hello World');
    return $response;
});

$router->get('/api', function(Request $request, Response $response) {

    $body = $request->request->all();
    $data = [
        "id" => 1,
        "timestamp" => time(),
        "uri" => '/api',
        "weight" => 32,
        "request" => []
    ];

    $response->setContent(json_encode(array_merge($body, $data)));
    $response->headers->set('Content-Type', 'application/json');

    return $response;
});

$router->run();
