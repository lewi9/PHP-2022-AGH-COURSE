<h2>Register</h2>
<form method="post" action="/auth/confirmation_notice">
    <label for="id">Id:</label>
    <input type="text" id="id" name="id"><br><br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>
    <label for="surname">Surname:</label>
    <input type="text" id="surname" name="surname"><br><br>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email"><br><br>
    <label for="password">Password:</label>
    <input type="text" id="password" name="password"><br><br>
    <label for="password_confirmation">Password confirmation:</label>
    <input type="text" id="password_confirmation" name=password_confirmation><br><br>
    <input type="submit" value="Create">

</form>

<?php
if (isset($flags)) {

    $names = array("id", "name", "surname", "email", "password", "password_confirmation");
    echo "<ul>";
    for ($i = 0; $i < 6; ++$i) {
        if ($flags[$i]) {
            echo "<li class='error'>" . "The " . $names[$i] . " filed cannot be empty" . "</li>";
        }
    }
    if ($flags[6]) {
        echo "<li class='error'>The password confirmation filed does not match the password field</li>";
    }
    echo "</ul>";
}
?>