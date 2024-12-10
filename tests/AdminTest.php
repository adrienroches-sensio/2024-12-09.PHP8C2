<?php

declare(strict_types=1);

namespace Test;

use App\Admin;
use App\BadCredentialsException;
use App\MemberLevel;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Admin::class)]
class AdminTest extends TestCase
{
    public function testCountIsKeptUpToDate(): void
    {
        $this->assertSame(0, Admin::count());

        $admin1 = self::createAdmin();

        $this->assertSame(1, Admin::count());

        unset($admin1);

        $this->assertSame(0, Admin::count());
    }

    public function testCanAuthenticateIfIsSuperAdmin(): void
    {
        $admin = self::createAdmin(
            level: MemberLevel::SuperAdmin,
        );

        $admin->auth('my-login', 'my-password');

        $this->addToAssertionCount(1);
    }

    public function testCanAuthenticateWithGoodCredentials(): void
    {
        $admin = self::createAdmin(
            login: 'my-login',
            password: 'my-password',
        );

        $admin->auth('my-login', 'my-password');

        $this->addToAssertionCount(1);
    }

    public function testAuthenticateFailsWithBadLoginAndGoodPassword(): void
    {
        $admin = self::createAdmin(
            login: 'my-login',
            password: 'my-password',
        );

        $this->expectException(BadCredentialsException::class);

        $admin->auth('other-login', 'my-password');
    }

    public function testAuthenticateFailsWithGoodLoginAndBadPassword(): void
    {
        $admin = self::createAdmin(
            login: 'my-login',
            password: 'my-password',
        );

        $this->expectException(BadCredentialsException::class);

        $admin->auth('my-login', 'other-password');
    }

    public function testCanBeCastedToString(): void
    {
        $admin = self::createAdmin(
            name: 'my-name',
            login: 'my-login',
            level: MemberLevel::SuperAdmin,
        );

        $this->assertSame('my-name #my-login as Super Admin', (string) $admin);
    }

    private static function createAdmin(
        string $name = 'fake',
        string $login = 'login',
        string $password = 'password',
        int $age = 12,
        MemberLevel $level = MemberLevel::Admin,
    ): Admin {
        return new Admin($name, $login, $password, $age, $level);
    }
}
