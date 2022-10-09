<?php

namespace App\Tests;

use App\Model\Button;
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testGetFunctionName()
    {
        $button = new Button();

        $this->assertTrue($button->hasAction());
    }
}
