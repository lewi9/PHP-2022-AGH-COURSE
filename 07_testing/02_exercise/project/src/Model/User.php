<?php

namespace Model;

use Exception as ExceptionAlias;

class User extends Model
{
    public bool $confirmed;
    public string $token;

    /**
     * @throws ExceptionAlias
     */
    public function __construct(int $id, string $name, string $surname, string $email, string $password)
    {
        parent::__construct($id, $name, $surname, $email);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->confirmed = false;
        $this->token = bin2hex(random_bytes(16));
    }
}
