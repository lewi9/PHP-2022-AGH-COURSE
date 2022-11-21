<h1 class="welcome">Welcome on homepage!</h1>

<?php
if (isset($flags)) {
    $logreg = 1;
    echo '<ul>';
    foreach ($flags as $flag) {
        if ($flag instanceof \Model\Flagi) {
            if ($flag->id() == 1) {
                echo "<li class='error'>Provided token is invalid!</li>";
                continue;
            }
            if ($flag->id() == 3) {
                echo "<li class='info'>Email successfully confirmed!</li>";
                continue;
            }
            if ($flag->id() == 2) {
                echo "<li class='error'>Email $flag->email does not exist!</li>";
                continue;
            }

            echo '<ul>';

            if ($flag->id() == 4) {
                echo "Welcome back " . $flag->name . "!";
                echo "<h3 class='user'>$flag->name $flag->surname</h3>";
                echo "<a href='/auth/logout'>Logout</a>";
                $logreg = 0;
            }

            if ($flag->id() == 5) {
                echo "Logged out successfully!";
            }
        }
    }
    if ($logreg) {
        echo "<a href='/auth/login'>Login</a>";
        echo "<a href='/auth/register'>Register</a>";
    }
} else {
    echo "<a href='/auth/login'>Login</a>";
    echo "<a href='/auth/register'>Register</a>";
}
