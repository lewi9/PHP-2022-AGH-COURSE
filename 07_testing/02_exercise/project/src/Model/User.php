<?php

namespace Model;

use Exception as ExceptionAlias;

class User extends Model
{
    public string $name;
    public string $surname;
    public string $email;
    public bool $confirmed;
    public string $password;
    public string $token;

    /**
     * @throws ExceptionAlias
     */
    public function __construct(int $id, string $name, string $surname, string $email, string $password)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->confirmed = false;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->token = bin2hex(random_bytes(32));
    }
}
