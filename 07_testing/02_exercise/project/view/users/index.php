<?php
if (!isset($users)) {
    exit('The $users is not set!');
}
?>
<p>Users:</p>
<ol>
    <?php foreach ($users as $user_id => $user) { ?>
        <li><a href="/users/<?= $user_id ?>"><?= $user['name'] ?></a></li>
    <?php } ?>
</ol>
