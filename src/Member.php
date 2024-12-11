<?php

namespace App;

use Override;
use SensitiveParameter;

class Member implements MemberInterface
{
    use MemberCountableTrait;

    public function __construct(
        private User $user,

        private string $login,

        #[SensitiveParameter]
        private string $password,

        private int $age,
    ) {
        self::add($this);
    }

    #[Override]
    public function auth(
        string $login,

        #[SensitiveParameter]
        string $password
    ): void {
        if (
            $this->login !== $login
            || $this->password !== $password
        ) {
            throw BadCredentialsException::forLogin($login);
        }
    }

    #[Override]
    public function __toString(): string
    {
        return "{$this->user} #{$this->login}";
    }
}
