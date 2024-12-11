#!/usr/bin/env php
<?php

//function generateArray(): array
//{
//    echo ' >> init' . PHP_EOL;
//    $letter = 'A';
//
//    $result = [$letter];
//
//    foreach (range(1, 10) as $i) {
//        ++$letter;
//        echo ' >> before append' . PHP_EOL;
//        $result[] = $letter;
//        echo ' >> after append' . PHP_EOL;
//    }
//
//    echo ' >> end' . PHP_EOL;
//    return $result;
//}
//
//echo ' >> start' . PHP_EOL;
//$array = generateArray();
//
//echo ' >> before foreach' . PHP_EOL;
//foreach ($array as $letter) {
//    echo $letter . PHP_EOL;
//}
//foreach ($array as $letter) {
//    echo $letter . PHP_EOL;
//}

function generateGenerator(): Generator
{
    echo ' >> init' . PHP_EOL;
    $letter = 'A';

    yield $letter;

    foreach (range(1, 10) as $i) {
        ++$letter;
        echo ' >> before yield' . PHP_EOL;
        yield $letter;
        echo ' >> after yield' . PHP_EOL;
    }

    echo ' >> end' . PHP_EOL;
}

echo ' >> start' . PHP_EOL;
$generator = generateGenerator();

echo ' >> before foreach' . PHP_EOL;
foreach ($generator as $letter) {
    echo $letter . PHP_EOL;
}

//function printer(): Generator
//{
//    $list = [];
//    echo "I'm printer!".PHP_EOL;
//    while (true) {
//        $string = yield;
//
//        if (false === $string) {
//            break;
//        }
//
//        $list[] = $string;
//        echo $string . PHP_EOL;
//    }
//
//    return $list;
//}
//
//$printer = printer();
//$printer->send('Hello world!');
//
//sleep (3);
//
//$printer->send('Bye world!');
//
//
//$printer->send(false);
//
//var_dump($printer->getReturn());
