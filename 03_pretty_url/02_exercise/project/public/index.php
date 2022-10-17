<?php

if($_SERVER["REQUEST_URI"] == "/")
    $_SERVER["REQUEST_URI"] = "/home";
$parts = explode('/', $_SERVER['REQUEST_URI']);
$view = "/" . $parts[1];
if($parts[1] == "user")
{
    if($parts[2]<1 or $parts[2] > 3)
    {
        $view = "404";
    }
}
else
{
    if ($parts[2] != "")
    {
        $view = "404";
    }
}
require "../views/layout.php";
