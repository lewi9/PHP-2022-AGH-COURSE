<?php

namespace Container;

class RingBuffer
{
    private int $capacity;
    private int $head;
    private int $tail;
    private int $size;
    /** @var array<mixed>*/
    private array $arr;

    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;
        $this->tail = 0;
        $this->head = 0;
        $this->size = 0;
        $this->arr = array();
    }

    public function empty(): bool
    {
        return !$this->size;
    }

    public function full(): bool
    {
        return $this->size() >= $this->capacity();
    }

    public function capacity(): int
    {
        return $this->capacity;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function push(mixed $item): void
    {
        if (!$this->full()) {
            $this->arr[$this->head++] = $item;
            $this->size++;
    }

    public function pop(): mixed
    {
        if (!$this->empty()) {
            $this->size--;
            return $this->arr[--$this->head];
        }
        return null;
    }

    public function tail(): mixed
    {
        if (!$this->empty()) {
            return $this->arr[$this->tail];
        }
        return null;
    }

    public function head(): mixed
    {
        if ($this->empty()) {
            return null;
        } elseif ($this->full()) {
            return $this->arr[$this->head];
        }
        return $this->arr[$this->head-1];
    }
}
