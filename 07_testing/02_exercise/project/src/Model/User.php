<?php

namespace Model;

use Exception as ExceptionAlias;

class User extends Model
{
    public bool $confirmed;
    public string|null $token;
    public string $name;
    public string $surname;
    public string $email;
    public string $password;

    /**
     * @throws ExceptionAlias
     */
    public function __construct(int $id)
    {
        parent::__construct($id);
        $this->confirmed = false;
        $this->token = bin2hex(random_bytes(16));
    }
}
