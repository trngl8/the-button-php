<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
#use Buki\Router\Router;

use App\Core\Router;

$request = Request::createFromGlobals();

//TODO: create routing:
//https://medium.com/the-andela-way/how-to-build-a-basic-server-side-routing-system-in-php-e52e613cf241

$map = [
    '/api' => 'DefaultController',
    '/api/hello' => 'hello',
];

$path = $request->getPathInfo();

//$router = new Router([
//    'paths' => [
//        'controllers' => 'Controller',
//    ],
//    'namespaces' => [
//        'controllers' => 'Controller',
//    ],
//]);

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

//$router->get('/default', 'DefaultController@main');
//
//// For auto discovering all methods and URIs
//$router->controller('/users', 'UserController');

$router->run();
