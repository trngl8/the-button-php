<?php

namespace App\Tests;

use App\Model\Button;
use PHPUnit\Framework\TestCase;

class ButtonTest extends TestCase
{
    public function testProcessButton()
    {
        $button = new Button('test', 'test');
        $button->press();
        $this->assertTrue($button->hasAction());
    }

    /**
     * @dataProvider placesProvider
     */
    public function testUserButtonPressed(string $place) : void
    {
        $button = new Button('Title Caption', 'go', 'red',  $place);

        $this->assertEquals($place, $button->getPlace());
        $this->assertEquals('Title Caption', $button->getTitle());
        $this->assertEquals('go', $button->getAction());
        $this->assertEquals('red', $button->getColor());
        $this->assertEquals('normal', $button->getSize());

        $button->press();

        $this->assertTrue($button->hasAction());
    }

    public function placesProvider() : iterable
    {
        yield ['site' => 'site'];
        yield ['application' => 'application'];
        yield ['settings' => 'settings'];
        yield ['device' => 'device'];
        yield ['profile' => 'profile'];
    }
}
