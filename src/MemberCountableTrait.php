<?php

declare(strict_types=1);

namespace App;

trait MemberCountableTrait
{
    public static function count(): int
    {
        return MemberCount::count(static::class);
    }
}
