<?php

namespace Storage;

use Concept\Distinguishable;

class SessionStorage implements Storage
{
    use SerializationHelpers;

    public function __construct()
    {
        session_start();
    }

    public function store(Distinguishable $distinguishable): void
    {
        $key = $distinguishable->key();
        $_SESSION[$key] = serialize($distinguishable);
    }

    /**
     * @return Distinguishable[]
     */
    public function loadAll(): array
    {
        $result = [];
        foreach ($_SESSION as $key => $value) {
            $result[] = self::deserializeAsDistinguishable($value);
        }
        return $result;
    }
}
