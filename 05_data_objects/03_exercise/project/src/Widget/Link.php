<?php

namespace Widget;

class Link extends Widget
{
    public function draw(): void
    {
        echo '<a href="">' . $this->key() . '</a>';
        echo "<br/>";
    }
}
