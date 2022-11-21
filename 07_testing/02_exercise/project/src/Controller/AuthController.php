<?php

namespace Controller;

use Exception as ExceptionAlias;
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
     * @return int[]
     */
    private function validate(): array
    {
        $flags = array(0, 0, 0, 0, 0, 0, 0, 0);
        $names = array("id", "name", "surname", "email", "password", "password_confirmation");
        for ($i=0; $i<6; ++$i) {
            if (!isset($_POST[$names[$i]])) {
                $flags[$i] = 1;
                $flags[7] = 1;
            }
        }

        if (!$flags[4] and !$flags[5]) {
            if ($_POST[$names[4]] != $_POST[$names[5]]) {
                $flags[7] = 1;
                $flags[6] = 1;
            }
        }

        return $flags;
    }

    /**
     * @throws StorageException
     * @throws ExceptionAlias
     */
    public function confirmation_notice(): Result
    {
        $flags = $this->validate();
        if ($flags[7]) {
            return view('auth.register')->withTitle("Register")->withLocation("/auth/register")->with('flags', $flags);
        }
        $this->save_user("sqlite", new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]));
        $this->save_user("mysql", new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]));
        return view('auth.confirmation_notice')->withTitle("Confirmation notice")->with('flags', $flags);
    }
}
