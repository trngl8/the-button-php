<?php

namespace App\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    private $request;

    private $response;

    private array $supportedHttpMethods = [
        "GET",
        "POST"
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $response = $response ?? new Response('', Response::HTTP_OK, ['content-type' => 'text/html']);
        $this->response = $response;
    }

    function __call($name, $args)
    {
        list($route, $method) = $args;

        if(!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
            return;
        }

        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    private function invalidMethodHandler() : void
    {
        $this->response = new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED, ['content-type' => 'text/html']);
    }

    private function defaultRequestHandler() : void
    {
        $this->response = new Response('Not Found', Response::HTTP_NOT_FOUND, ['content-type' => 'text/html']);
    }

    public function getResponse() : Response
    {
        return $this->response;
    }

    /**
     * Resolves a route
     */
    public function run() : void
    {
        $methodDictionary = $this->{strtolower($this->request->getMethod())};
        $formattedRoute = $this->formatRoute($this->request->getRequestUri());

        if(!array_key_exists($formattedRoute, $methodDictionary)) {
            $this->defaultRequestHandler();
            return;
        }

        $method = $methodDictionary[$formattedRoute];

        call_user_func_array($method, [$this->request, $this->response]);

        $this->response->send();
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     */
    private function formatRoute(string $route) : string
    {
        $result = rtrim($route, '/');

        if ($result === '') {
            return '/';
        }

        return $result;
    }

    function __destruct()
    {
        // you can implement running routing on descructor
        // don't forget to make run() protected
        // $this->run();
    }
}
