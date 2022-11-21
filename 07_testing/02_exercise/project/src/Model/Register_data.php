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


    /**
     * @return int[]
     */
    public function check(): array
    {
        $check = array(0,0,0,0,0,0,0);
        if (!$this->was_id) {
            $check[0] = 1;
        }
        if ($this->name == '') {
            $check[1] = 1;
        }
        if ($this->surname == '') {
            $check[2] = 1;
        }
        if ($this->email == '') {
            $check[3] = 1;
        }
        if ($this->password== '') {
            $check[4] = 1;
        }
        if ($this->password_confirmed == '') {
            $check[5] = 1;
        }
        if ($this->password != $this->password_confirmed) {
            $check[6] = 1;
        }

        return $check;
    }
}
