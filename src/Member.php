<?php

class Member
{
    public function __construct(
        private string $login,

        #[SensitiveParameter]
        private string $password,

        private int $age,
    ) {
    }

    public function auth(
        string $login,

        #[SensitiveParameter]
        string $password
    ): bool {
        return $this->login === $login && $this->password === $password;
    }
}
