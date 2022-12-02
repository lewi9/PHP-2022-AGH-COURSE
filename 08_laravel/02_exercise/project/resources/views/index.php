<h1>Comments</h1>

<?php
if (isset($comments)) {
    foreach ($comments as $comment) {
        echo "<a href='/comments/'".$comment->id()."'>$comment->title</a>";
    }
}
