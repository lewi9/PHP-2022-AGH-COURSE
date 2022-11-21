<h2>Login</h2>

<form method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?=$_POST["email"]?? ''?>"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Enter">
</form>

<?php
if (isset($incorrect)) {
    if ($incorrect) {
        echo "<ul><li class='error'>Password is invalid!</li>";
    }
}
