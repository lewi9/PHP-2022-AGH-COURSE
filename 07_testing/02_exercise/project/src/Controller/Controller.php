<?php

namespace Controller;

use Storage\Exception\StorageException;
use Storage\Storage;
use Storage\StorageFactory;

function view(string $name): Result
{
    return Result::view($name);
}

function redirect(string $location): Result
{
    return Result::redirect($location);
}

class Controller
{
    private StorageFactory $storageFactory;

    public function __construct(StorageFactory $storageFactory)
    {
        $this->storageFactory = $storageFactory;
    }

    /**
     * @throws StorageException
     */
    protected function storage(string $type = "mysql"): Storage
    {
        return $this->storageFactory->create($type);
    }
}
