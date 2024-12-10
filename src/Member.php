<?php

namespace App;

use Override;
use SensitiveParameter;

class Member extends User implements MemberInterface
{
    use MemberCountableTrait;

    public function __construct(
        string $name,

        private string $login,

        #[SensitiveParameter]
        private string $password,

        private int $age,
    ) {
        self::add($this);

        parent::__construct($name);
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
        return "{$this->getName()} #{$this->login}";
    }
}
