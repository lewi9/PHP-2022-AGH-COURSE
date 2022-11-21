<?php

namespace Controller;

use Exception as ExceptionAlias;
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
        $this->check();
        return view('auth.register')->withTitle("Register");
    }

    /**
     * @throws StorageException
     */
    private function save_user(string $type, User $user): void
    {
        $storage = $this->storage($type);

        $storage->store($user);
    }

    /**
     * @throws StorageException
     * @throws ExceptionAlias
     */
    public function confirmation_notice(): Result
    {
        $register_data = new Register_data(_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"], $_POST["password_confirmation"]);
        $user = new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]);
        $this->save_user("sqlite",$user );
        $this->save_user("mysql", $user );
        $this->save_user("session", $user );
        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }
}
