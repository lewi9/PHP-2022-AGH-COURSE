<?php

namespace Controller;

use Exception as ExceptionAlias;
use Model\User;
use Storage\Exception\StorageException;

class AuthController extends Controller
{
    /**
     * @var array|int[]
     */
    private array $flags;
    private int $validated;
    public function index(): Result
    {
        return view('auth.index')->withTitle("Auth");
    }

    public function register(): Result
    {
        if ($this->validated) {
            return view('auth.register')->withTitle("Register")->with('flags', $this->flags);
        }
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

    private function validate(): void
    {
        $this->flags = array(0, 0, 0, 0, 0, 0, 0, 0);
        $names = array("id", "name", "surname", "email", "password", "password_confirmation");
        for ($i=0; $i<6; ++$i) {
            if (!$_POST[$names[$i]]) {
                $this->flags[$i] = 1;
                $this->flags[7] = 1;
            }
        }

        if (!$this->flags[4] and !$this->flags[5]) {
            if ($_POST[$names[4]] != $_POST[$names[5]]) {
                $this->flags[7] = 1;
                $this->flags[6] = 1;
            }
        }
        $this->validated = 1;
    }

    /**
     * @throws StorageException
     * @throws ExceptionAlias
     */
    public function confirmation_notice(): Result
    {
        $this->validate();
        if ($this->flags[7]) {
            return redirect("/auth/register");
        }
        $this->save_user("sqlite", new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]));
        $this->save_user("mysql", new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]));
        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }
}
