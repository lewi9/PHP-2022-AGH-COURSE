<?php

namespace Widget;

use Concept\Distinguishable;

abstract class Widget extends Distinguishable
{
    public abstract function draw(): void;
}