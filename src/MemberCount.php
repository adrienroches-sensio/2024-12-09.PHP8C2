<?php

namespace App;

class MemberCount
{
    /**
     * @var array<class-string<MemberInterface>, int>
     */
    private static array $count = [];

    public static function add(MemberInterface $member): int
    {
        self::$count[$member::class] ??= 0;
        ++self::$count[$member::class];

        return self::$count[$member::class];
    }

    public static function remove(MemberInterface $member): int
    {
        self::$count[$member::class] ??= 0;
        --self::$count[$member::class];

        return self::$count[$member::class];
    }

    /**
     * @param class-string<MemberInterface> $class
     */
    public static function count(string $class): int
    {
        return self::$count[$class] ?? 0;
    }
}
