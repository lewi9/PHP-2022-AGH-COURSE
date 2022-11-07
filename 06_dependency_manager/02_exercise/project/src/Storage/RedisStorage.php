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
     * @inheritDoc
     */
    public function loadAll(): array
    {
        $distinguishable = array();
        $allKeys = $this->client->keys("*");
        foreach ($allKeys as $key) {
            if($t = $this->client->get("$key")){
                $distinguishable[] = self::deserializeAsDistinguishable($t);
            }
        }
        return $distinguishable;
    }
}
