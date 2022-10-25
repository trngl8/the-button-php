<?php

namespace App\Tests;

use App\Core\Router;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RouterTest extends TestCase
{
    public function testRouterResponse404()
    {
        $request = new Request();

        $router = new Router($request);

        $router->get('/api', function(Request $request) {
            echo "hello";
        });

        $router->run();

        $result = $router->getResponse();

        $this->assertEquals(404, $result->getStatusCode());
    }

    public function testRouterResponse405()
    {
        $request = new Request();

        $router = new Router($request);

        $router->put('/api', function(Request $request) {
            echo "hello";
        });

        $result = $router->getResponse();

        $this->assertEquals(405, $result->getStatusCode());
    }

    public function testRouterResponse200()
    {
        $request = new Request();

        $router = new Router($request);

        $router->get('/', function(Request $request) {
            echo "hello";
        });

        $router->run();

        $result = $router->getResponse();

        $this->assertEquals(200, $result->getStatusCode());
    }
}
