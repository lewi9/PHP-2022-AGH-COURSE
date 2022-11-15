<?php

namespace Widget;

class Button extends Widget
{
    public function draw(): void
    {
        echo '<input type="button" value="' . $this->key() . '">';
        echo "<br/>";
    }
}
