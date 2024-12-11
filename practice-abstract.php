#!/usr/bin/env php
<?php

abstract class CounterString
{
    public function count(): int
    {
        return strlen($this->getString());
    }

    abstract protected function getString(): string;
}

class Coucou extends CounterString
{
    protected function getString(): string
    {
        return 'coucou';
    }
}

class Hello extends CounterString
{
    protected function getString(): string
    {
        return 'hello';
    }
}

$coucou = new Coucou();

echo $coucou->count();
