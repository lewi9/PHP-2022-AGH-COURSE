<?php

namespace Storage;

use Concept\Distinguishable;
use Predis\Client;

class RedisStorage implements Storage
{
    use SerializationHelpers;

    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function store(Distinguishable $distinguishable): void
    {
        $this->client->set($distinguishable->key(), serialize($distinguishable));
    }

    /**
     * @return Distinguishable[]
     */
    public function loadAll(): array
    {
        return $this->load('*');
    }

    /**
     * @return Distinguishable[]
     */
    public function load(string $pattern): array
    {
        $keys = $this->client->keys($pattern);
        $objects = $this->client->mget($keys);

        $result = [];

        foreach ($objects as $object) {
            $result[] = self::deserializeAsDistinguishable($object);
        }

        return $result;
    }

    public function remove(string $key): void
    {
        $this->client->del([$key]);
    }
}
