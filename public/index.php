<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

$request = Request::createFromGlobals();

$map = [
    '/api/hello' => 'hello',
];

$path = $request->getPathInfo();

if (isset($map[$path])) {

    $body = $request->request->all();

    if($request->getContentType() === 'json') {
        $body = json_decode($request->getContent(), true);
    }

    $data = [
        "id" => 1,
        "timestamp" => time(),
        "uri" => $path,
        "weight" => 32,
        "request" => []
    ];

    $data = array_merge($data, $body);

    $response = new JsonResponse($data);
} else {
    $response = new JsonResponse('Not Found', 404);
}

$response->send();
