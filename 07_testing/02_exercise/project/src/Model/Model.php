<?php

namespace Model;

use Concept\Distinguishable;

abstract class Model extends Distinguishable
{
    public string $name;
    public string $surname;
    public string $email;
    public string $password;

    public function __construct(int $id, string $name, string $surname, string $email)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }
}
