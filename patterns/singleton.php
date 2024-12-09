#!/usr/bin/env php
<?php

class Singleton
{
    private static self $instance;

    private function __construct()
    {
    }

    public static function get(): self
    {
        return self::$instance ??= new self();
    }
}

$i1 = Singleton::get();
$i2 = Singleton::get();

echo 'Are two instances the same ?' . PHP_EOL;
var_dump($i1 === $i2);
