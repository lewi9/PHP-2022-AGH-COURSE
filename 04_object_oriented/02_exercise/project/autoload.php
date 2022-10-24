<?php

spl_autoload_register(function (string $name) {

    $name = str_replace('\\','/',$name);

    require "src/" . $name . ".php";
});
