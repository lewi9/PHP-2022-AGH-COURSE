<?php

namespace Storage;

use Concept\Distinguishable;

class RedisStorage implements Storage
{

    public function store(Distinguishable $distinguishable): void
    {
        // TODO: Implement store() method.
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {
        // TODO: Implement loadAll() method.
    }
}