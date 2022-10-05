
<?php
$user = $_GET["user"];
$password = $_GET["password"];
if ($user=="" or $password=="")
{
    echo "EMPTY";
    return "EMPTY";
}
if ($user=="foo" and $password=="foo123")
{
    echo "OK";
    return "OK";
}
{
    echo "ERROR";
    return "ERROR";
}


?>

