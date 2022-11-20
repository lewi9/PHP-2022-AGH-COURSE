<?php

namespace String;

class Editor
{
    private string $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function get(): string
    {
        return $this->string;
    }

    public function replace(string $search, string $replace): void
    {
        str_replace($search, $replace, $this->string);
    }

    public function lower
}
