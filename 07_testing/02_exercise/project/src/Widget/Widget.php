<?php

namespace Widget;

use Concept\Distinguishable;

abstract class Widget extends Distinguishable
{
    abstract public function draw(): void;
}
