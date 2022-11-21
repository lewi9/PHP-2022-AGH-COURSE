<h2>Please confirm user registration...</h2>
<?php
if (isset($flags)) {
    $names = array("id", "name", "surname", "email", "password", "password_confirmation");
    echo "<ul>";
    for ($i=0;$i<6;++$i) {
        if ($flags[$i]) {
            echo "<li class='error'>" . "The " . $names[$i] . " filed cannot be empty" . "</li>";
        }
    }
    echo "</ul>";
    print_r
}
?>