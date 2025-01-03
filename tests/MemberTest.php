<?php

declare(strict_types=1);

namespace Test;

use App\BadCredentialsException;
use App\Member;
use App\User;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

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

    public function testCanAuthenticateWithGoodCredentials(): void
    {
        $member = self::createMember(
            login: 'my-login',
            password: 'my-password',
        );

        $member->auth('my-login', 'my-password');

        $this->addToAssertionCount(1);
    }

    public function testAuthenticateFailsWithBadLoginAndGoodPassword(): void
    {
        $member = self::createMember(
            login: 'my-login',
            password: 'my-password',
        );

        $this->expectException(BadCredentialsException::class);

        $member->auth('other-login', 'my-password');
    }

    public function testAuthenticateFailsWithGoodLoginAndBadPassword(): void
    {
        $member = self::createMember(
            login: 'my-login',
            password: 'my-password',
        );

        $this->expectException(BadCredentialsException::class);

        $member->auth('my-login', 'other-password');
    }

    public function testCanBeCastedToString(): void
    {
        $member = self::createMember(
            name: 'my-name',
            login: 'my-login',
        );

        $this->assertSame('my-name #my-login', (string) $member);
    }

    private static function createMember(
        string $name = 'fake',
        string $login = 'login',
        string $password = 'password',
        int $age = 12,
    ): Member {
        return new Member(new User($name), $login, $password, $age);
    }
}
