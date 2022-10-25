<?php

namespace Widget;

class Link extends Widget
{

    public function draw(): void
    {
        echo "<a href=''>parent::key()</a>";
    }
}