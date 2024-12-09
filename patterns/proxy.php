#!/usr/bin/env php
<?php

interface SomeInterface
{
    public function doSomething(): string;
}

class Plop implements SomeInterface
{
    public function doSomething(): string
    {
    }
}

class ProxyCache implements SomeInterface
{
    private string $cache;

    public function __construct(
        private SomeInterface $inner,
    ) {
    }

    public function doSomething(): string
    {
        return $this->cache ??= $this->inner->doSomething();
    }
}

function main(SomeInterface $some) {
    $some->doSomething();
}

$plop = new Plop();
$plop = new ProxyCache($plop);

main($plop);
