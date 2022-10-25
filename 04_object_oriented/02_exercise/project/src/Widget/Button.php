<?php

namespace Widget;

class Button extends Widget
{
    public function draw(): void
    {
        echo "<input type='button' value=this->key()>";
    }
    public function key(int $id): string
    {
        return "Widget" . static::class . $id;
    }
}