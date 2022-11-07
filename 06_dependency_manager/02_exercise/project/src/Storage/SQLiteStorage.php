<?php

namespace Storage;

use Config\Directory;

class SQLiteStorage extends SQLStorage
{
    public function __construct()
    {
        $path = Directory::storage() . "SQLiteStorage/db.sqlite";
        $dsn = "sqlite:" . $path;

        parent::__construct($dsn);
    }
}
