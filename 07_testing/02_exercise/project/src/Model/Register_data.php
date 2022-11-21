<?php

namespace Model;

class Register_data extends Model
{
    public string $password_confirmed;
    public int $was_id = 1;

    public function __construct(string $id, string $name, string $surname, string $email, string $password, string $password_confirmed)
    {
        if (!$id) {
            $this->was_id = 0;
            $id = 1;
        }
        $id = (int) $id;
        parent::__construct($id, $name, $surname, $email);
        $this->password = $password;
        $this->password_confirmed = $password_confirmed;
    }
}
