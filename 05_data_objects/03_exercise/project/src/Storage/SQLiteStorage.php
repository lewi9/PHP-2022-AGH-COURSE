<?php

namespace Storage;

use Config\Directory;
use PDO;

class SQLiteStorage extends DataBaseStorage
{
    private string $databaseName = "db.sqlite";

    public function __construct()
    {
        /* if (file_exists(Directory::storage() . "SQLiteStorage/" . $this->databaseName)) {
             echo shell_exec("rm -f " . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
         }*/
        $this->pdo = new PDO("sqlite:" . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
        parent::__construct();
    }

   /* public function __destruct()
    {
        echo shell_exec("rm -f " . Directory::storage() . "SQLiteStorage/" . $this->databaseName);
    }*/
}
