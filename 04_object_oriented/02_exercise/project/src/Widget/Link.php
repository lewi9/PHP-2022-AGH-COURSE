<?php

namespace Widget;

class Link extends Widget
{
    public function draw(): void
    {

    }
    public function key(int $id): string
    {
        return "Widget" . static::class . $id;
    }
}