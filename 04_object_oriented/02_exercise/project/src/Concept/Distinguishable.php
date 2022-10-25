<?php

namespace Concept;

abstract class Distinguishable
{
    private int $id;

    public abstract function key(): string;
}