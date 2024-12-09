<?php

class Admin extends Member
{
    public function __construct(
        string $login,

        #[SensitiveParameter]
        string $password,

        int $age,

        private string $level = 'ADMIN',
    ) {
        parent::__construct($login, $password, $age);
    }

    public function auth(
        string $login,

        #[SensitiveParameter]
        string $password,
    ): bool {
        if ($this->level === 'SUPERADMIN') {
            return true;
        }

        return parent::auth($login, $password);
    }


}
