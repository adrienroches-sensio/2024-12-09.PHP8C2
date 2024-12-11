#!/usr/bin/env php
<?php

abstract class Controller
{
    public const int ITEMS_PER_PAGE = 10;

    abstract protected function getPath(): string;

    public function run(): void
    {
        echo "On {$this->getPath()}, there will be " . static::ITEMS_PER_PAGE . " items per page.";
    }
}

class IndexController extends Controller
{
    public const int ITEMS_PER_PAGE = 50;

    protected function getPath(): string
    {
        return '/';
    }
}

$controller = new IndexController();
$controller->run();


echo PHP_EOL . '------------------------------------' . PHP_EOL;

class TestStatic
{
    private static int $itemsPerPage;

    public function __construct()
    {
        self::$itemsPerPage = random_int(1, 55);
    }

    public function hello(): void
    {
        echo static::$itemsPerPage . PHP_EOL;
    }

    public static function world(): void
    {
        echo self::$itemsPerPage . PHP_EOL;
    }
}

class ChildStatic extends TestStatic
{
    private static int $itemsPerPage = 12;
}

$plop = new TestStatic();
$plip = new TestStatic();
$plap = new ChildStatic();

$plop::world();
$plip::world();
$plap::world();
