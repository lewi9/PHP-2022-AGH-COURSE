<?php

namespace Storage;

use Concept\Distinguishable;

class SQLiteStorage implements Storage
{
    use SerializationHelpers;

    private PDO $pdo;
    private int $id = 1;

    public function __construct()
    {
        $this->pdo = new PDO("sqlite:/tmp/sqlite.db");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __destruct()
    {
        echo shell_exec("rm -f /tmp/sqlite.db");
    }

    public function store(Distinguishable $distinguishable): void
    {

    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {

    }
}