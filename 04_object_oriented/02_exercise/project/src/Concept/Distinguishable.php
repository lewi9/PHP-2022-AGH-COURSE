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
        return strtolower(str_replace("\\", "_", static::class) . "_". $this->id);
    }
}