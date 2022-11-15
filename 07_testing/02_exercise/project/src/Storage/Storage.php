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

    /**
     * @return Distinguishable[]
     */
    public function load(string $pattern): array;

    public function remove(string $key): void;
}
