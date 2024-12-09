<?php

interface CanBeAuthenticatedInterface
{
    public function auth(
        string $login,

        #[SensitiveParameter]
        string $password
    ): bool;
}
