<h1>Comments</h1>

<?php
if (isset($comments)) {
    foreach ($comments as $com) {
        if ($com instanceof \App\Models\Comment) {
            echo "<a href='/comments/'".$com->id."'>$com->title</a>";
        }
    }
}

if (isset($comment)) {
    foreach ($comment as $com) {
        echo "<h1>$com->title</h1>";
        echo "<p>$com->text</p>";
    }
}
