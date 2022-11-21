<?php

namespace Model;

class Register_data extends Model
{

    private string $password_confirmed;
    public function __construct(int $id, string $name, string $surname, string $email, string $password, string $password_confirmed)
    {
        parent::__construct($id, $name, $surname, $email);
        $this->password = $password;
        $this->password_confirmed = $password_confirmed;

    }
}