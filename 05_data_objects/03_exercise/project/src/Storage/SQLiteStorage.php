<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

use PDO;

class SQLiteStorage implements Storage
{
    use SerializationHelpers;

    private PDO $pdo;
    private static int $id = 1;
    private string $databaseName = "db.sqlite";
    private string $tableName = "objects";

    public function __construct()
    {
        try {
            $flag = false;
            if (file_exists(Directory::storage() . "SQLiteStorage/" . $this->databaseName)) {
                $flag = true;
            }
            $this->pdo = new PDO("sqlite:" . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
            if ($flag) {
                $query = $this->pdo->query("SELECT MAX(id) FROM $this->tableName ");
                if ($query) {
                    SQLiteStorage::$id = $query->fetchAll(PDO::FETCH_NUM)[0][0];
                }
                $flag = false;
            }
        } catch (\PDOException $e) {
            exit("Sqlite database cannot be created: $e");
        }

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

   /* public function __destruct()
    {
        echo shell_exec("rm -f " . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
    }*/

    public function store(Distinguishable $distinguishable): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS $this->tableName (id INTEGER PRIMARY KEY, Distinguishable TEXT NOT NULL)");
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName VALUES (:id, :Distinguishable)");
        $serializedDistinguishable = serialize($distinguishable);
        $statement->bindValue('id', ++SQLiteStorage::$id);
        $statement->bindValue('Distinguishable', $serializedDistinguishable);
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
