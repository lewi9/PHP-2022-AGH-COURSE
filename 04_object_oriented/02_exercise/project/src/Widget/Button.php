<?php

namespace Widget;

class Button extends Widget
{
    public function draw(): void
    {
        $t = parent::key();
        echo "<input type='button' value=$t>";
    }
}