<?php

namespace Container;

class RingBuffer
{
    private int $capacity;
    private int $head;
    private int $tail;
    private int $size;

    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;
        $this->tail = $capacity;
        $this->head = 0;
        $this->size = 0;
    }

    public function empty(): bool
    {
        return !$this->size;
    }
}
