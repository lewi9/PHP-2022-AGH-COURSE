<h1 class="welcome">Welcome on homepage!</h1>
<a href="/auth/login">Login</a>
<a href="/auth/register">Register</a>

<?php
if (isset($flags)) {
    echo '<ul>';
    foreach ($flags as $flag) {
        if ($flag instanceof \Model\Flagi) {
            if ($flag->id() == 2) {
                echo "<li class='error'>Email \'$flag->email\' does not exist!</li>";
            }
        }
    }

    echo '<ul>';
}
