#!/usr/bin/env php
<?php

class StepIterator implements Iterator
{
    private bool $isValid = true;

    public function __construct(
        private array $array,
        private int $step = 1,
    ) {
        if ($this->step < 1) {
            $this->step = 1;
        }
    }

    public function current(): mixed
    {
        return current($this->array);
    }

    public function next(): void
    {
        for ($i = 0; $i < $this->step; $i++) {
            $this->isValid = false !== next($this->array);
        }
    }

    public function key(): mixed
    {
        return key($this->array);
    }

    public function valid(): bool
    {
        return $this->isValid;
    }

    public function rewind(): void
    {
        reset($this->array);
    }
}

$range = range(1, 100);
$rangeIterator = new ArrayIterator($range);

foreach (new StepIterator($range, 50) as $i) {
    echo $i . PHP_EOL;
}
