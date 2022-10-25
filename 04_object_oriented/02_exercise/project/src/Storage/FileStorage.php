<?php

namespace Storage;

use Concept\Distinguishable;

class FileStorage implements Storage
{
    public function store(Distinguishable $distinguishable) : void
    {
        $data = serialize($distinguishable);
        $file = $distinguishable.key();
    }
    public function loadAll() : iterable
    {
        return;
    }
}