<?php

namespace Storage;

use Concept\Distinguishable;
use PDO;

class MySQLStorage implements Storage
{
    use SerializationHelpers;

    private PDO $pdo;
    private int $id = 0;
    public function __construct()
    {
        echo shell_exec("docker run --name=mysql --net=host --rm --env MYSQL_ROOT_PASSWORD=root123 --env MYSQL_DATABASE=test --env MYSQL_USER=test --env MYSQL_PASSWORD=test123 -d mysql/mysql-server:8.0");
        echo shell_exec("while ! timeout 1 bash -c 'echo > /dev/tcp/localhost/3306' 2> /dev/null; do sleep 1; done; echo 'Done.'");
        $this->pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "test", "test123");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __destruct()
    {
        echo shell_exec("docker container stop mysql");
    }

    public function store(Distinguishable $distinguishable): void
    {

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS Storage (id INT PRIMARY KEY, Distinguishable TEXT)");
        $serializedDistinguishable = serialize($distinguishable);
        $statement = $this->pdo->prepare("INSERT INTO Storage VALUES (:id, :Distinguishable)");
        $statement->bindValue('id', ++$this->id);
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
        $query->fetchAll(PDO::FETCH_NUM);
        foreach($query as $array)
        {
            $distinguishable = self::deserializeAsDistinguishable($array[1]);
        }
        return $distinguishable;
    }
}