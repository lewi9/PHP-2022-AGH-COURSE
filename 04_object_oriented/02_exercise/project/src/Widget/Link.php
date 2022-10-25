<?php

namespace Widget;

class Link extends Widget
{
    public function draw(): void
    {
        echo "<a href=''>this->key.()</a>";
    }
    public function key(int $id): string
    {
        return "Widget" . static::class . $id;
    }
}