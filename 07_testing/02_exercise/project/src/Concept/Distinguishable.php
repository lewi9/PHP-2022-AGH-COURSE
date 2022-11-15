<?php

namespace Concept;

abstract class Distinguishable
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function key(): string
    {
        $name = strtolower(str_replace('\\', '_', static::class));
        return $name . "_" . $this->id;
    }
}
