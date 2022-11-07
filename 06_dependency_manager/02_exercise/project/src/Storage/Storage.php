<?php

namespace Storage;

use Concept\Distinguishable;

interface Storage
{
    public function store(Distinguishable $distinguishable): void;

    /**
     * @return Distinguishable[]
     */
    public function loadAll(): array;
}
