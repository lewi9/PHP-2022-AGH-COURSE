<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
    public function executeInDatabase($sql)
    {
        $dbh = $this->getModule('Db')->_getDbh();

        $this->debugSection('Query', $sql);

        $sth = $dbh->prepare($sql);
        return $sth->execute();
    }
}
