<?php

namespace Storage;

use Concept\Distinguishable;

class SessionStorage implements Storage
{
    use SerializationHelpers;

    public function __construct()
    {
        session_start(); // @phpstan-ignore-line
    }

    public function store(Distinguishable $distinguishable): void
    {
        $key = $distinguishable->key();
        $value = serialize($distinguishable);
        $_SESSION[$key] = $value; // @phpstan-ignore-line
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
        $result = [];
        $values = $_SESSION; // @phpstan-ignore-line
        foreach ($values as $key => $value) {
            if (fnmatch($pattern, $key)) {
                $result[] = self::deserializeAsDistinguishable($value);
            }
        }
        return $result;
    }

    public function remove(string $key): void
    {
        unset($_SESSION[$key]); // @phpstan-ignore-line
    }
}
