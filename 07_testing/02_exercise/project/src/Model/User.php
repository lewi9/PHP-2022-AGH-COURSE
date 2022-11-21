<?php

namespace Model;

use Exception as ExceptionAlias;

class User extends Model
{
    public bool $confirmed;
    public string $token;
    public string $name;
    public string $surname;
    public string $email;
    public string $password;

    /**
     * @throws ExceptionAlias
     */
    public function __construct1(int $id){
        parent::__construct($id);
    }

    public function __construct(int $id, string $name, string $surname, string $email, string $password)
    {
        parent::__construct($id);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->confirmed = false;
        $this->token = bin2hex(random_bytes(16));
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }
}
