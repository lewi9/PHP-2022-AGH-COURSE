<?php
if (!isset($user)) {
    exit('The $user is not set!');
}
?>
<p>User:</p>
<p><strong>Name:</strong> <?= $user['name']?></p>
<p><strong>Surname:</strong> <?= $user['surname']?></p>
<p><strong>Age:</strong> <?= $user['age']?></p>
