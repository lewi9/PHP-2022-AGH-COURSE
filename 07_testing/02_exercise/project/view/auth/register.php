<h2>Register</h2>

<?php
$names = array("id", "name", "surname", "email", "password", "password_confirmation");
$flag = 0;
$flags = array(0,0,0,0,0,0,0);
for ($i = 0; $i<6; $i++) {
    if (!$_POST[$names[$i]]) {
        $flag = 1;
        $flags[$i] = 1;
    }
}
if (!($flags[4] or $flags[5])) {
    if ($flags[4] != $flags[5]) {
        $flags[6] = 1;
    }
}

if($flag){
    echo "<ul>";
    for($i = 0; $i<6; ++$i){
        
    }
}

?>

<form method="post" action="/auth/confirmation_notice">
    <label for="id">Id:</label>
    <input type="text" id="id" name="id" value="<?=$_POST["id"]?>"><br><br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?=$_POST["name"]?>>"<br><br>
    <label for="surname">Surname:</label>
    <input type="text" id="surname" name="surname" value="<?=$_POST["surname"]?>"><br><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?=$_POST["email"]?>"><br><br>
    <label for="password">Password:</label>
    <input type="text" id="password" name="password" value="<?=$_POST["password"]?>"><br><br>
    <label for="password_confirmation">Password confirmation:</label>
    <input type="text" id="password_confirmation" name=password_confirmation value="<?=$_POST["password_confirmation"]?>"><br><br>
    <input type="submit" value="Create">

</form>