<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

$request = Request::createFromGlobals();

$map = [
    '/hello' => 'hello',
];

$path = $request->getPathInfo();

if (isset($map[$path])) {
    $data = [
        "id" => 1,
        "timestamp" => time(),
        "uri" => $path,
        "weight" => 32
    ];

    if (array_key_exists('message', $_POST)) {
      $data['message'] = $_POST['message'];
    }
    
    $response = new JsonResponse($data);
} else {
    $response = new JsonResponse('Not Found', 404);
}

$response->send();
