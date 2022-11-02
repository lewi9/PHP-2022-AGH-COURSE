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
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS Storage (id INTEGER PRIMARY KEY, Distinguishable TEXT NOT NULL)");
        $statement = $this->pdo->prepare("INSERT INTO Storage VALUES (:id, :Distinguishable)");
        ++$this->id;
        $serializedDistinguishable = serialize($distinguishable);
        $statement->bindValue('id', $this->id);
        $statement->bindValue('Distinguishable', `$serializedDistinguishable`);
        $statement->execute();
        $this->id++;
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {

    }
}