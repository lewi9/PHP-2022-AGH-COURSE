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

    /**
     * @return Distinguishable[]
     */
    public function loadAll(): array
    {
        $distinguishable = array();

        $exclude = array( ".","..",".gitignore");
        if(scandir(Directory::storage()))
        {
            $dir = scandir(Directory::storage());
            foreach($dir as $file)
                if(!in_array($file,$exclude))
                {
                    $t = Directory::Storage() . "/". $file;
                    $tt = (string) file_get_contents($t);
                    $ttt = unserialize($tt);
                    $distinguishable[] = $ttt;
                }
        }


        return $distinguishable;
    }
}