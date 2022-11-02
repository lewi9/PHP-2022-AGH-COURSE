<?php

namespace Storage;

use PDO;

class MySQLStorage extends DataBaseStorage
{
    public function __construct()
    {
        //echo shell_exec("docker run --name=mysql --net=host --rm --env MYSQL_ROOT_PASSWORD=root123 --env MYSQL_DATABASE=test --env MYSQL_USER=test --env MYSQL_PASSWORD=test123 -d mysql/mysql-server:8.0");
        //echo shell_exec("while ! timeout 1 bash -c 'echo > /dev/tcp/localhost/3306' 2> /dev/null; do sleep 1; done; echo 'Done.'");
        $this->pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "test", "test123");
        //$this->pdo->exec("DELETE FROM $this->tableName");
        parent::__construct();
    }


    /*public function __destruct()
    {
        echo shell_exec("docker container stop mysql");
    }*/
}
