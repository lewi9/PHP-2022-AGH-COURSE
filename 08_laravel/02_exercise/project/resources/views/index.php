<h1>Comments</h1>

<?php
if (isset($comments)) {
    foreach ($comments as $comment) {
        echo "<a href='/comments/'".$comment->id."'>$comment->title</a>";
    }
}

if (isset($comment)) {
    foreach ($comment as $com) {
        echo "<h1>$com->title</h1>";
        echo "<p>$com->text</p>";
    }
}
