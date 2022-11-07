<?php

// Error reporting

error_reporting(-1);
ini_set("display_errors", "On");

// Autoload

require("../vendor/autoload.php");
require "../vendor/predis/predis/autoload.php";
Predis\Autoloader::register();
// Setup directory config

Config\Directory::set("../");

// App example

$uriParts = explode('/', $_SERVER['REQUEST_URI']);
array_shift($uriParts);

if ($uriParts[0] == "") {
    $uriParts[0] = "FileStorage";
}

$app = new App();
$app->run($uriParts[0]);
