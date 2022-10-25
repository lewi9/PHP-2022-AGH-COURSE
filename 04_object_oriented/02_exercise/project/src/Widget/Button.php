<?php

namespace Widget;

class Button extends Widget
{
    public function draw(): void
    {
        // TODO: Implement draw() method.
    }
    public function key(int $id): string
    {
        return "Widget" . static::class . $id;
    }
}