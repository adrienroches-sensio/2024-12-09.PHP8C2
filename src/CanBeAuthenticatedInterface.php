<?php

namespace App;

use SensitiveParameter;

interface CanBeAuthenticatedInterface
{
    /**
     * @throws BadCredentialsException If login or password failed
     */
    public function auth(
        string $login,

        #[SensitiveParameter]
        string $password
    ): void;
}
