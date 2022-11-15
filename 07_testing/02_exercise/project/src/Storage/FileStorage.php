<?php

namespace Storage;

use Concept\Distinguishable;
use Config\Directory;

class FileStorage implements Storage
{
    use SerializationHelpers;

    public function store(Distinguishable $distinguishable): void
    {
        $fileName = Directory::storage() . "FileStorage/" . $distinguishable->key();
        file_put_contents($fileName, serialize($distinguishable));
    }

    /**
     * @return Distinguishable[]
     */
    public function loadAll(): array
    {
        return $this->load('*');
    }

    /**
     * @return Distinguishable[]
     */
    public function load(string $pattern): array
    {
        $ignored = ['..', '.', '.gitignore'];

        $files = scandir(Directory::storage() . "FileStorage/");

        if (!$files) {
            exit("Cannot scan director!");
        }

        $files = array_diff($files, $ignored);

        $result = [];

        foreach ($files as $file) {
            if (fnmatch($pattern, $file)) {
                $contents = file_get_contents(Directory::storage() . "FileStorage/" . $file);
                if (!$contents) {
                    exit("Cannot get file contents!");
                }
                $result[] = self::deserializeAsDistinguishable($contents);
            }
        }

        return $result;
    }

    public function remove(string $key): void
    {
        unlink(Directory::storage() . "FileStorage/" . $key);
    }
}
