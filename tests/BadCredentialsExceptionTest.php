<?php

declare(strict_types=1);

namespace Test;

use App\BadCredentialsException;
use Error;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Throwable;
use function is_a;

#[CoversClass(BadCredentialsException::class)]
class BadCredentialsExceptionTest extends TestCase
{
    public function testConstructorIsPrivate(): void
    {
        // Arrange

        // Assert
        $this->expectException(Error::class);
        $this->expectExceptionMessageMatches('#.*Call to private.*#');

        // Act
        new BadCredentialsException();
    }

    public function testClassIsThrowable(): void
    {
        $this->assertTrue(is_a(BadCredentialsException::class, Throwable::class, true));
    }

    public function testCanCreateExceptionForLoginIssues(): void
    {
        // Arrange
        $exception = BadCredentialsException::forLogin('fake');

        // Assert
        $this->expectException(BadCredentialsException::class);
        $this->expectExceptionMessage('Bad credentials for login \'fake\'.');
        $this->expectExceptionCode(404);

        // Act
        throw $exception;
    }
}
