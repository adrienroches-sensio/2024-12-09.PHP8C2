<?php

declare(strict_types=1);

namespace App;

use Override;

trait MemberCountableTrait
{
    /**
     * @var array<class-string<MemberInterface>, int>
     */
    private static array $count = [];

    public function __destruct()
    {
        self::remove($this);
    }

    private static function add(MemberInterface $member): int
    {
        self::$count[$member::class] ??= 0;
        ++self::$count[$member::class];

        return self::$count[$member::class];
    }

    private static function remove(MemberInterface $member): int
    {
        self::$count[$member::class] ??= 0;
        --self::$count[$member::class];

        return self::$count[$member::class];
    }

    #[Override]
    public static function count(): int
    {
        return self::$count[static::class] ?? 0;
    }
}
