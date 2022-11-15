<?php

use Storage\Exception\StorageException;
use Storage\Storage;
use Storage\StorageFactory;
use Storage\StorageFactoryImpl;
use Config\Directory;
use Controller\Result;

class App
{
    public function run(): void
    {
        $requestUri = $_SERVER['REQUEST_URI']; // @phpstan-ignore-line
        $parts = explode('/', $requestUri);
        array_shift($parts);

        $option = $parts[0] ?? 'home' ?: 'home';

        $controllerClassName = "Controller\\" . ucwords($option) . "Controller";

        $storageFactory = new StorageFactoryImpl();
        $sessionStorage = $this->getSessionStorage($storageFactory);

        if (class_exists($controllerClassName)) {
            $controller = new $controllerClassName($storageFactory);

            $controllerMethodName = $parts[1] ?? 'index' ?: 'index';
            $controllerMethodArguments = array_slice($parts, 2);

            if (is_numeric($controllerMethodName)) {
                $controllerMethodName = "show";
                $controllerMethodArguments = array_slice($parts, 1);
            }

            if (method_exists($controller, $controllerMethodName)) {
                /**
                 * @var Result $result
                 */
                $result = $controller->$controllerMethodName(...$controllerMethodArguments);
            } else {
                Log::error("No such method '$controllerMethodName' in '$controllerClassName'.");
                $result = Result::view("404")->withTitle('404');
            }
        } else {
            Log::error("No such class '$controllerClassName'.");
            $result = Result::view("404")->withTitle('404');
        }

        $location = $result->getLocation();

        if ($location) {
            header("Location: $location");
        }

        $view = $result->getView();

        if ($view) {
            $file = Directory::view() . str_replace('.', '/', $view) . '.php';

            foreach ($result->getEntries() as $entry) {
                $key = $entry->getKey();
                if (isset(${$key})) {
                    Log::error("Variable with name '$key' is already defined and has value '${$key}'.");
                } else {
                    ${$key} = $entry->getValue();
                }
            }

            require_once(Directory::view() . 'layout.php');
        }
    }

    private function getSessionStorage(StorageFactory $storageFactory): Storage
    {
        try {
            return $storageFactory->create("session");
        } catch (StorageException $e) {
            exit($e->getMessage());
        }
    }
}
