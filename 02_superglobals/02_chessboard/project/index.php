<?php
error_reporting(-1);
ini_set("display_errors", "On");

session_start();

$sx = $_SESSION["sx"] ?? 10;
$sz = $_SESSION["sz"] ?? 10;
$col = $_SESSION["col"] ?? array();
$counter = $_SESSION["count"] ?? 0;
$x = $_SESSION["x"] ?? 0;
$y = $_SESSION["y"] ?? 0;
$color = $_COOKIE["color"]??"gray";

if(isset($_COOKIE["color"]))
{
    //$color = $_COOKIE["color"];
    setcookie("color", $color);
    $_COOKIE["color"] = $color;
}

else
{
    if($_SESSION["craate_cookie"])
    {
        setcookie("color", "gray");
        $_COOKIE["color"] = "gray";
        $_SESSION["craate_cookie"] = 0;
    }
    $_SESSION["craate_cookie"] = 1;


}

if(isset($_POST["color"]))
{
    $color =  $_POST['color'] == "" ? $_COOKIE["color"] : $_POST["color"];
}

?>

<html lang="en">
<head>
    <title>Superglobals</title>

    <style type="text/css">
        .block {
            display: inline-block;
            width: 30px;
            height: 30px;
            padding: 0;
            margin: 0;
        }

        .block:hover {
            background-color: lightgray;
        }

        .red {
            background-color: red;
        }

        .blue {
            background-color: blue;
        }

        .green {
            background-color: green;
        }

        .gray {
            background-color: gray;
        }

        .white {
            background-color: white;
        }
    </style>
</head>
<body>


    <?php

    if(isset($_GET["x"]))
    {
        Count_Click();
        if($counter==2)
        {
            $counter = 0;
            Bresenham($x??0,$y??0,$_GET["x"],$_GET["z"]);
        }
        else
        {
            $x = $_GET["x"];
            $y = $_GET["z"];
        }
    }

    if(isset($_POST["sz"]))
    {
        $sz = $_POST["sz"] == "" ? $_SESSION["sz"] : $_POST["sz"];
    }

    if(isset($_POST["sx"]))
    {
        $sx = $_POST["sx"] == "" ? $_SESSION["sx"] : $_POST["sx"];
    }

    for($i = 0; $i < $sz; $i++)
    {
        echo "<div>";
        for ($ii = 0; $ii<$sx; $ii++)
        {
            if(!isset($col["$ii"]["$i"]))
            {
                $col["$ii"]["$i"] = $color;
            }

            if($col["$ii"]["$i"] != "white")
            {
                $col["$ii"]["$i"] = $color;
            }

            $temp = $col["$ii"]["$i"];

            echo "<a class=\"block $temp\" href=\"?x=$ii&z=$i\"></a>";
        }
        echo "</div>";
    }

    ?>

<!--
<div>
    <a class="block gray" href="?x=0&z=1"></a>
    <a class="block gray" href="?x=1&z=1"></a>
    <a class="block gray" href="?x=2&z=1"></a>
</div>
<div>
    <a class="block gray" href="?x=0&z=2"></a>
    <a class="block gray" href="?x=1&z=2"></a>
    <a class="block gray" href="?x=2&z=2"></a>
</div>
-->

<br/>

<form method="post">
    <label>
        Columns:
        <input type="text" name="sx">
    </label>
    <label>
        Rows:
        <input type="text" name="sz">
    </label>
    <input type="submit" value="Change">
</form>

<form method="post">
    <label>
        Color:
        <select name="color">
            <option value="gray">Gray</option>
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>
        </select>
    </label>
    <input type="submit" value="Change">
</form>

    <?php
    $_SESSION["sx"] = $sx;
    $_SESSION["sz"] = $sz;
    $_SESSION["col"] = $col;
    $_SESSION["count"] = $counter;
    $_SESSION["x"] = $x;
    $_SESSION["y"] = $y;
    ?>
</body>
</html>

<?php
function Count_Click()
{
    global $counter;
    $counter +=1;
}

function Bresenham($x1, $y1, $x2, $y2)
{
    global $col;
    $x = $x1;
    $y = $y1;

    if ($x1 < $x2)
    {
        $xi = 1;
        $dx = $x2 - $x1;
    }
    else
    {
        $xi = -1;
        $dx = $x1 - $x2;
    }

    if ($y1 < $y2)
    {
        $yi = 1;
        $dy = $y2 - $y1;
    }
    else
    {
        $yi = -1;
        $dy = $y1 - $y2;
    }

    $col[$x][$y] = "white";

    if ($dx > $dy)
    {
        $ai = ($dy - $dx) * 2;
        $bi = $dy * 2;
        $d = $bi - $dx;

        while ($x != $x2)
        {

            if ($d >= 0)
            {
                $x += $xi;
                $y += $yi;
                $d += $ai;
            }
            else
            {
                $d += $bi;
                $x += $xi;
            }
                $col[$x][$y] = "white";
         }
    }

    else
    {
        $ai = ( $dx - $dy ) * 2;
        $bi = $dx * 2;
        $d = $bi - $dy;

        while ($y != $y2)
        {

            if ($d >= 0)
            {
                $x += $xi;
                $y += $yi;
                $d += $ai;
            }
            else
            {
                $d += $bi;
                $y += $yi;
            }
            $col[$x][$y] = "white";
        }
    }
}
?>