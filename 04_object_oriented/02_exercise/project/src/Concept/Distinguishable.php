<?php

namespace Concept;

abstract class Distinguishable
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function key(): string
    {
        return static::class . $this->id;
    }
}