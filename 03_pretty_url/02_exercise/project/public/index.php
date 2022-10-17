<?php

    if($_SERVER["REQUEST_URI"] == "/")
        $_SERVER["REQUEST_URI"] = "/home";
    $parts = explode('/', $_SERVER['REQUEST_URI']);
    $view = "/" . $parts[1];
    require "../views/layout.php";

?>