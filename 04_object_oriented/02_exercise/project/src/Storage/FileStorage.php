<?php

namespace Storage;

use Concept\Distinguishable;

class FileStorage implements Storage
{
    public function store(Distinguishable $distinguishable) : void
    {

    }
    public function loadAll() : iterable
    {
        return;
    }
}