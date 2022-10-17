<html lang="en">
<head>
    <title>Pretty URL</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<?php require "menu.php" ;

try
{
    require "../views$view.php";
}
catch(Error $e)
{
    require "../views/404.php";
}
?>


</body>
</html>