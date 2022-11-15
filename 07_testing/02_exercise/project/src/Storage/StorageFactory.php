<?php

namespace Storage;

use Storage\Exception\UnknownStorageTypeException;

interface StorageFactory
{
    /**
     * @throws UnknownStorageTypeException
     */
    public function create(string $type): Storage;
}
