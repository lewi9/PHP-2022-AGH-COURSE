<?php

namespace Widget;

class Link extends Widget
{

    public function draw(): void
    {
        $t = parent::key();
        echo "<a href=\"\">$t</a>";
    }
}