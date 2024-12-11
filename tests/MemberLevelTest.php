<?php

declare(strict_types=1);

namespace Test;

use App\MemberLevel;
use Generator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

#[CoversClass(MemberLevel::class)]
class MemberLevelTest extends TestCase
{
    public static function memberLevelProvider(): Generator
    {
        foreach (MemberLevel::cases() as $level) {
            yield $level->name => [$level];
        }
    }

    #[TestDox('"$_dataName" have a label')]
    #[DataProvider('memberLevelProvider')]
    public function testCaseHaveALabel(MemberLevel $level): void
    {
        $level->label();

        $this->addToAssertionCount(1);
    }
}
