<?php

namespace App\Tests;

use App\Controller\DefaultController;
use PHPUnit\Framework\TestCase;

class BaseBehaviourTest extends TestCase
{
    public function testApiRequest()
    {
        $controller = new DefaultController(); //Controller class

        // Do some action
        $result = $controller->api();

        $this->assertEquals(['result' => true], $result);
    }
}
