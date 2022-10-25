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
    public function loadAll() : array
    {
        $distinguishable = array();
        $dir = scandir(Directory::storage());
        for($i=3; $i <8; $i++)
                $distinguishable[] = unserialize(file_get_contents(Directory::Storage() . $dir[$i]));


        return $distinguishable;
    }
}