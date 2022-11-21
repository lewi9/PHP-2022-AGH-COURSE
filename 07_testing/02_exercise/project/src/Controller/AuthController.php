<?php

namespace Controller;

use Exception as ExceptionAlias;
use Model\Model;
use Model\User;
use Storage\Exception\StorageException;

class AuthController extends Controller
{
    public function index(): Result
    {
        return view('auth.index')->withTitle("Auth");
    }

    /**
     * @throws StorageException
     */
    public function register(): Result
    {
        if(isset($_POST["id"])) {
            if(!(!$_POST["id"] or !$_POST["name"] or !$_POST["surname"] or !$_POST["email"] or !$_POST["password"] or !$_POST["password_confirmation"] or $_POST["password"] != $_POST["password_confirmation"])) {
                return redirect("/auth/register");
            }
        }

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

    /**
     * @throws StorageException
     * @throws ExceptionAlias
     */
    public function confirmation_notice(): Result
    {
        $user = new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]);
        $this->save_model("sqlite", $user);
        $this->save_model("mysql", $user);
        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }
}
