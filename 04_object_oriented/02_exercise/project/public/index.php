<?php

// Error reporting

error_reporting(-1);
ini_set("display_errors", "On");

// Autoload

require ("../autoload.php");

// Setup directory config

Config\Directory::set("../");

// App example

$app = new App();
$app->run();
