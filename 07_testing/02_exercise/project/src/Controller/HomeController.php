<?php

namespace Controller;

use Codeception\Lib\Di;
use Concept\Distinguishable;
use Storage\Exception\StorageException;

class HomeController extends Controller
{
    /**
     * @throws StorageException
     */
    public function index(): Result
    {
        $flags = $this->loadFlagi();
        return view('home.index')->withTitle('Homepage')->with('flags', $flags);
    }

    /**
     * @throws StorageException
     * @return Distinguishable[]
     */
    private function loadFlagi(): array
    {
        $storage = $this->storage('session');
        $flags = $storage->load("model_flagi*");
        foreach ($flags as $flag) {
            if ($flag instanceof Distinguishable) {
                if ($flag->id() != 4) {
                    $storage->remove($flag->key());
                }
            }
        }
        return $flags;
    }
}
