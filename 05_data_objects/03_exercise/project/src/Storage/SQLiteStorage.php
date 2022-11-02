<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

use PDO;

class SQLiteStorage implements Storage
{
    use SerializationHelpers;

    private $pdo = null;
    static private int $id = 1;

    public function __construct()
    {
        try {
            if( $this->pdo == null)
                $this->pdo = new PDO("sqlite:" . Directory::storage() . "SQLiteStorage/" . "sqlite.db");
        } catch (\PDOException $e) {
            exit("Sqlite database cannot be created: $e");
        }

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

   /* public function __destruct()
    {
        echo shell_exec("rm -f " . Directory::storage() . "SQLiteStorage/" ."sqlite.db");
    }*/

    public function store(Distinguishable $distinguishable): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS Storage (id INTEGER PRIMARY KEY, Distinguishable TEXT NOT NULL)");
        $statement = $this->pdo->prepare("INSERT INTO Storage VALUES (:id, :Distinguishable)");
        $serializedDistinguishable = serialize($distinguishable);
        $statement->bindValue('id', ++self::$id);
        $statement->bindValue('Distinguishable', $serializedDistinguishable);
        $statement->execute();
    }

    /**
     * @inheritDoc
     */
    public function loadAll(): array
    {
        $distinguishable = array();
        $query = $this->pdo->query("SELECT * FROM Storage");
        if ($query) {
            foreach ($query->fetchAll(PDO::FETCH_NUM) as $array) {
                $distinguishable[] = self::deserializeAsDistinguishable($array[1]);
            }
        }


        return $distinguishable;
    }
}
