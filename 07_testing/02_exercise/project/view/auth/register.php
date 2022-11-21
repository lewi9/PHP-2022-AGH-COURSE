<h2>Register</h2>

<?php
if(isset($_POST["id"])){
    $names = array("id", "name", "surname", "email", "password", "password_confirmation");
    $flag = 0;
    $flags = array(0,0,0,0,0,0,0);
    for ($i = 0; $i<6; $i++) {
        if (!$_POST[$names[$i]]) {
            $flag = 1;
            $flags[$i] = 1;
        }
    }
    if (!$flags[4] and !$flags[5]) {
        if ($_POST[$names[4]] != $_POST[$names[5]]) {
            $flags[6] = 1;
            $flag = 1;
            $_POST[$names[4]] = '';
            $_POST[$names[5]] = '';
        }
    }

    if ($flag) {
        echo "<ul>";
        for ($i = 0; $i<5; ++$i) {
            if($flags[$i]) {
                echo sprintf("<li class='error'>The %s filed cannot be empty</li>", $names[$i]);
            }
        }
        if($flags[5]) {
            echo "<li class='error'>The password confirmation filed cannot be empty</li>";
        }
        if($flags[6]) {
            echo "<li class='error'>The password confirmation filed does not match the password field</li>";
        }
        echo "</ul>";
    }

}

?>

<form method="post">
    <label for="id">Id:</label>
    <input type="text" id="id" name="id" value="<?=$_POST["id"]?? ''?>"><br><br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?=$_POST["name"]?? ''?>"><br><br>
    <label for="surname">Surname:</label>
    <input type="text" id="surname" name="surname" value="<?=$_POST["surname"]?? ''?>"><br><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?=$_POST["email"]?? ''?>"><br><br>
    <label for="password">Password:</label>
    <input type="text" id="password" name="password" value="<?=$_POST["password"]?? ''?>"><br><br>
    <label for="password_confirmation">Password confirmation:</label>
    <input type="text" id="password_confirmation" name=password_confirmation value="<?=$_POST["password_confirmation"]?? ''?>"><br><br>
    <input type="submit" value="Create">

</form>