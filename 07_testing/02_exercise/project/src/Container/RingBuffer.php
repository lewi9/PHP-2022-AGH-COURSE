<?php

namespace Container;

class RingBuffer
{
    private int $capacity;
    private int $head;
    private int $tail;
    private int $size;
    /** @var array<int> */
    private array $arr;

    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;
        $this->tail = $capacity;
        $this->head = 0;
        $this->size = 0;
        $this->arr = array();
    }

    public function empty(): bool
    {
        return !$this->size;
    }

    public function capacity(): int
    {
        return $this->capacity;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function push(int $item): void
    {
        if ($this->size() + 1 <= $this->capacity()) {
            $this->arr[] = $item;
            $this->head++;
            $this->size++;
        }
    }
}
