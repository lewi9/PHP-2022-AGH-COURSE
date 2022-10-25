<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

class FileStorage implements Storage
{
    public function store(Distinguishable $distinguishable) : void
    {
        $data = serialize($distinguishable);
        $file = $distinguishable->key();
        file_put_contents(Directory::storage() . "/" . $file, $data);
    }
    public function loadAll(): array
    {
        $distinguishable = array();

        //$dir = scandir(Directory::storage());
        $dir = array_diff(scandir(Directory::storage()), array('..', '.', ".gitignore"));
        $count = 3;
        while(isset($dir[$count]))
            $count++;
        for($i = 3; $i<$count; $i++)
        {
            $t = Directory::Storage() . "/". $dir[$i];
            $tt = file_get_contents($t);
            $distinguishable[$i-3] = unserialize($tt);
        }

        // PHP analyzer shown that is wrong
        /*for($i=3; $i <sizeof($dir); $i++)
            $distinguishable[$i-3] = unserialize(file_get_contents(Directory::Storage() . "/". $dir[$i]));*/

        return $distinguishable;
    }
}