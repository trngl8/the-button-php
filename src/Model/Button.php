<?php

namespace App\Model;

class Button
{
    CONST DEFAULT_COLOR = 'blue';
    CONST DEFAULT_PLACE = 'site';

    private string $title;

    private string $action;

    private string $place;

    private string $color;

    private string $size = 'normal';

    private bool $pressed = false;

    public function __construct(string $title, string $action, $color = self::DEFAULT_COLOR, $place = self::DEFAULT_PLACE)
    {
        $this->place = $place;
        $this->color = $color;
        $this->title = $title;
        $this->action = $action;
    }

    public function getPlace() : string
    {
        return $this->place;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getSize() : string
    {
        return $this->size;
    }

    public function hasAction() : bool
    {
        return $this->pressed;
    }

    public function getAction() : string
    {
        return $this->action;
    }

    public function getColor() : string
    {
        return $this->color;
    }

    public function press() : void
    {
        $this->pressed = true;
    }
}
