<?php

declare(strict_types=1);

namespace Test;

use App\MemberLevel;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(MemberLevel::class)]
class MemberLevelTest extends TestCase
{
    public function testAllCasesHaveALabel(): void
    {
        foreach (MemberLevel::cases() as $case) {
            $case->label();

            $this->addToAssertionCount(1);
        }
    }
}
