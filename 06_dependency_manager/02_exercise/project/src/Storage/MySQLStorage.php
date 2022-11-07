<?php

namespace Storage;

class MySQLStorage extends SQLStorage
{
    public function __construct()
    {
        $dsn = "mysql:host=127.0.0.1;port=3306;dbname=test";
        $username = "test";
        $password = "test123";

        parent::__construct($dsn, $username, $password);
    }
}
