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
     * @throws ExceptionAlias
     */
    public function register(): Result
    {
        if (isset($_POST["id"])) {
            if (!(!$_POST["id"] or !$_POST["name"] or !$_POST["surname"] or !$_POST["email"] or !$_POST["password"] or !$_POST["password_confirmation"] or $_POST["password"] != $_POST["password_confirmation"])) {
                $user = new User((int) $_POST["id"]);
                $user->name = $_POST["name"];
                $user->surname = $_POST["surname"];
                $user->email = $_POST["email"];
                $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $this->save_model("sqlite", $user);
                $this->save_model("mysql", $user);
                return view('auth.confirmation_notice')->withTitle("Confirmation notice")->withLocation('/auth/confirmation_notice');
            }
        }
        return view('auth.register')->withTitle("Register");
    }

    public function confirm(): Result
    {
        return view('home.index')->withTitle("Home")->withLocation("/");
    }

    /**
     * @throws StorageException
     */
    private function save_model(string $type, Model $user): void
    {
        $storage = $this->storage($type);

        $storage->store($user);
    }

    public function confirmation_notice(): Result
    {
        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }
}
