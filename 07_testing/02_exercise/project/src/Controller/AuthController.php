<?php

namespace Controller;

use Concept\Distinguishable;
use Exception as ExceptionAlias;
use Model\Flagi;
use Model\User;
use Storage\Exception\StorageException;

class AuthController extends Controller
{
    public function index(): Result
    {
        return redirect('/auth/login');
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
                //$this->save_model("sqlite", $user);
                $this->save_model("mysql", $user);
                return redirect('/auth/confirmation_notice');
            }
        }
        return view('auth.register')->withTitle("Register");
    }

    /**
     * @throws StorageException
     */
    public function confirm(string $token): Result
    {
        if ($user = $this->findInUser('mysql', $token, 'token')) {
            $flag = new Flagi(3);
            $this->save_model('session', $flag);
            $user->confirmed = true;
            $user->token = null;
            $this->save_model("mysql", $user);
            return redirect('/');
        }
        $flag = new Flagi(1);
        $this->save_model('session', $flag);
        return redirect('/');
    }

    /**
     * @throws StorageException
     */
    private function save_model(string $type, Distinguishable $user): void
    {
        $storage = $this->storage($type);

        $storage->store($user);
    }

    public function confirmation_notice(): Result
    {
        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }

    /**
     * @throws StorageException
     */
    private function findInUser(string $type, string $string, string $field): User|null
    {
        $storage = $this->storage($type);
        $disting = $storage->load("model_user*");
        foreach ($disting as $user) {
            if ($user instanceof User) {
                if ($field == "email") {
                    if ($user->email == $string) {
                        return $user;
                    }
                }
                if ($field == "token") {
                    if ($user->token == $string) {
                        return $user;
                    }
                }
            }
        }
        return null;
    }

    /**
     * @throws StorageException
     */
    public function login(): Result
    {
        if (isset($_POST["email"]) and isset($_POST["password"])) {
            if ($_POST["email"] != '' and $_POST["password"] != '') {
                if (($user = $this->findInUser('mysql', $_POST["email"], 'email'))) {
                    if (password_verify($_POST["password"], $user->password)) {
                        if ($user->token) {
                            return redirect("/auth/confirmation_notice");
                        }
                        $flag = new Flagi(4);
                        $flag->name = $user->name;
                        $flag->surname = $user->surname;
                        $this->save_model('session', $flag);
                        return redirect('/');
                    } else {
                        $incorrect = 1;
                        return view('auth.login')->withTitle("Login")->with('incorrect', $incorrect);
                    }
                } else {
                    $flag = new Flagi(2);
                    $flag->email = "'" . $_POST["email"] ."'";
                    $this->save_model('session', $flag);
                    return redirect('/');
                }
            }
        }
        return view('auth.login')->withTitle("Login");
    }

    /**
     * @throws StorageException
     */
    public function logout(): Result
    {
        $storage = $this->storage('session');
        $storage->remove('model_flagi_4');
        $flag = new Flagi(5);
        $this->save_model('session', $flag);
        return redirect("/");
    }
}
