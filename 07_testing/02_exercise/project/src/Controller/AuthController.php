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

    /**
     * @throws StorageException
     */
    public function register(): Result
    {
        $flags = $this->flags();
        if ($flags) {
            if ($flags[0] instanceof Register_data) {
                $flags = $flags[0]->check();
                foreach ($flags as $flag) {
                    if ($flag) {
                        return view('auth.register')->withTitle("Register")->with('flags', $flags);
                    }
                }
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
     * @return mixed[]
     */
    private function flags(): array
    {
        $storage = $this->storage('session');

        $items = $storage->load("model_register*");

        if ($items) {
            if ($items[0] instanceof Register_data) {
                return $items[0]->check();
            }
        }

        return array();
    }

    /**
     * @throws StorageException
     * @throws ExceptionAlias
     */
    public function confirmation_notice(): Result
    {
        $register_data = new Register_data($_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"], $_POST["password_confirmation"]);
        $this->save_model("session", $register_data);
        $flags = $this->flags();
        if ($flags[0] instanceof Register_data) {
            $flags = $flags[0]->check();
            foreach ($flags as $flag) {
                if ($flag) {
                    return redirect('/auth/register');
                }
            }
        }
        $user = new User((int) $_POST["id"], $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["password"]);
        $this->save_model("sqlite", $user);
        $this->save_model("mysql", $user);

        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }
}
