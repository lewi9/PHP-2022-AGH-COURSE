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

    public function replace(string $search, string $replace): Editor
    {
        $this->string = str_replace($search, $replace, $this->string);
        return $this;
    }

    public function lower(): Editor
    {
        $this->string = strtolower($this->string);
        return $this;
    }

    public function upper(): Editor
    {
        $this->string = strtoupper($this->string);
        return $this;
    }

    public function censor(string $replace): Editor
    {
        $count = strlen($replace);
        return $this->replace("$replace", str_repeat("*", $count));
    }

    public function repeat(string $repeat, int $count): Editor
    {
        return $this->replace($repeat, str_repeat($repeat, $count));
    }

    public function remove(string $remove): Editor
    {
        return $this->replace("$remove", "");
    }
}
