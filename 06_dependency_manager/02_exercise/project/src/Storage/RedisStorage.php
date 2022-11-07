<?php

namespace Storage;

use Concept\Distinguishable;

class RedisStorage implements Storage
{
    use SerializationHelpers;

    private Predis\Client $client;
    public function __construct()
    {
        $this->client = new Predis\Client();
    }

    public function store(Distinguishable $distinguishable): void
    {
        $this->client->set($distinguishable->key(),serialize($distinguishable));
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {
        $distinguishable = []
        $allKeys = $this->client->keys("*");
        foreach
    }
}