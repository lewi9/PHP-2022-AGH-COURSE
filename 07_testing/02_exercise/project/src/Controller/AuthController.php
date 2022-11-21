<?php

namespace Controller;

use Exception as ExceptionAlias;
use Model\Model;
use Model\Register_data;
use Model\User;
use Storage\Exception\StorageException;

class AuthController extends Controller
{
    public function index(): Result
    {
        return view('auth.index')->withTitle("Auth");
    }

    public function register(): Result
    {
        //$this->check();
        return view('auth.register')->withTitle("Register");
    }

    /**
     * @throws StorageException
     */
    private function save_model(string $type, Model $user): void
    {
        $storage = $this->storage($type);

        $storage->store($user);
    }

    private function validate(): void
    {
        $storage = $this->storage('session');

        $item = $storage->load("register_*");
    }

    /**
     * @throws StorageException
     * @throws ExceptionAlias
     */
    public function confirmation_notice(): Result
    {
        $register_data = new Register_data($_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"], $_POST["password_confirmation"]);
        $this->save_model("session", $register_data);
        $user = new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]);
        $this->save_model("sqlite", $user);
        $this->save_model("mysql", $user);

        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }
}
