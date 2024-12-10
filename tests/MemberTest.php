<?php

declare(strict_types=1);

namespace Test;

use App\Member;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use SensitiveParameter;

#[CoversClass(Member::class)]
class MemberTest extends TestCase
{
    public function testCountIsKeptUpToDate(): void
    {
        $this->assertSame(0, Member::count());

        $member1 = self::createMember();

        $this->assertSame(1, Member::count());

        unset($member1);

        $this->assertSame(0, Member::count());
    }

    private static function createMember(
        string $name = 'fake',
        string $login = 'login',
        string $password = 'password',
        int $age = 12,
    ): Member {
        return new Member($name, $login, $password, $age);
    }
}
