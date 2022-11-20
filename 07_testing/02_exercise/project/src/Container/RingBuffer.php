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
        if ($this->full()) {
            $this->tail = ($this->tail+1)%$this->capacity();
        }
        if (!$this->full()) {
            $this->size++;
        }
        $this->arr[$this->head] = $item;
        $this->head = ($this->head+1)%$this->capacity();
    }

    public function pop(): mixed
    {
        if (!$this->empty()) {
            $this->size--;
            if (++$this->tail >= $this->capacity()) {
                $this->tail = 0;
                return $this->arr[$this->capacity()-1];
            }
            return $this->arr[$this->tail-1];
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
        } elseif ($this->head-1 < 0) {
            return $this->arr[$this->capacity()-1];
        }
        return $this->arr[$this->head-1];
    }

    public function at(int $index): mixed
    {
        if (($index >= $this->tail and $index < $this->head) or ($index >= $this->tail and $this->head <= $this->tail)
            or ($index < $this->head and $this->head <= $this->tail)) {
            return $this->arr[$index];
        }
        return null;
    }
}
