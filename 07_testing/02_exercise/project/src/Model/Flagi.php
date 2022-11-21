<?php

namespace Model;

class Flagi extends Model
{
    public string $email;
    public function __construct(int $id)
    {
        parent::__construct($id);
    }
}