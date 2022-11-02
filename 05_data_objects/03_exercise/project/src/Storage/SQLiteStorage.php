<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

use PDO;

class SQLiteStorage implements Storage
{
    use SerializationHelpers;

    private PDO $pdo;
    private string $databaseName = "db.sqlite";
    private string $tableName = "objects";

    public function __construct()
    {
        if (file_exists(Directory::storage() . "SQLiteStorage/" . $this->databaseName)) {
            echo shell_exec("rm -f " . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
        }
        $this->pdo = new PDO("sqlite:" . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

   /* public function __destruct()
    {
        echo shell_exec("rm -f " . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
    }*/

    public function store(Distinguishable $distinguishable): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $this->tableName (key TEXT PRIMARY KEY, data TEXT NOT NULL)");
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName VALUES (:key, :data)");
        $serializedDistinguishable = serialize($distinguishable);
        $statement->bindValue('key', $distinguishable->key());
        $statement->bindValue('data', $serializedDistinguishable);
        $statement->execute();
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {
        $distinguishable = array();
        $query = $this->pdo->query("SELECT * FROM $this->tableName");
        if ($query) {
            foreach ($query->fetchAll(PDO::FETCH_NUM) as $array) {
                $distinguishable[] = self::deserializeAsDistinguishable($array[1]);
            }
        }

        return $distinguishable;
    }
}
