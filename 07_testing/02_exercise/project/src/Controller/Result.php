<?php

namespace Controller;

class Result
{
    private ?string $view = null;
    private ?string $location = null;

    /**
     * @var Entry[]
     */
    private array $entries = [];

    public function withView(string $view): Result
    {
        $this->view = $view;
        return $this;
    }

    public function withLocation(string $location): Result
    {
        $this->location = $location;
        return $this;
    }

    public function with(string $key, mixed $value): Result
    {
        $this->entries[] = new Entry($key, $value);
        return $this;
    }

    public function withTitle(string $title): Result
    {
        return $this->with('title', $title);
    }

    public static function view(string $name): Result
    {
        return (new Result())->withView($name);
    }

    public static function redirect(string $location): Result
    {
        return (new Result())->withLocation($location);
    }

    public function getView(): ?string
    {
        return $this->view;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return Entry[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }
}
