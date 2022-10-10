<?php
error_reporting(-1);
ini_set("display_errors", "On");
session_start();
$v = $_SESSION['v'] ?? 0;
$v = $v + 1;
$_SESSION['v'] = $v;
if (!isset($_COOKIE['c'])) {
    setcookie('c', "Value");
}
$c = $_COOKIE['c'];
echo "v: $v, c: $c"
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

<div>
    <a class="block gray" href="?x=0&z=0"></a>
    <a class="block gray" href="?x=1&z=0"></a>
    <a class="block gray" href="?x=2&z=0"></a>
</div>
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

</body>
</html>
