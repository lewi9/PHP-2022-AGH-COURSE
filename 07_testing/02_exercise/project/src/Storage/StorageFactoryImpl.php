<?php

namespace Storage;

use Log;
use Storage\Exception\UnknownStorageTypeException;

class StorageFactoryImpl implements StorageFactory
{
    /**
     * @var array<string, Storage>
     */
    private array $cache = [];


    /**
     * @throws UnknownStorageTypeException
     */
    public function create(string $type): Storage
    {
        if (!isset($this->cache[$type])) {
            $this->cache[$type] = $this->createUncached($type);
        }

        return $this->cache[$type];
    }

    /**
     * @throws UnknownStorageTypeException
     */
    private function createUncached(string $type): Storage
    {
        if ($type == "mysql") {
            return new MySQLStorage();
        } elseif ($type == "sqlite") {
            return new SQLiteStorage();
        } elseif ($type == "file") {
            return new FileStorage();
        } elseif ($type == "session") {
            return new SessionStorage();
        } elseif ($type == "redis") {
            return new RedisStorage();
        }

        Log::error("Unknown storage type '$type'!");

        throw new UnknownStorageTypeException($type);
    }
}
