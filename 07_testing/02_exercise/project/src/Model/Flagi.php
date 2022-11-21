<?php

namespace Model;

class Flagi extends Model
{
    public string $email;
    public string $name;
    public string $surname;
    public function __construct(int $id)
    {
        parent::__construct($id);
    }
}
