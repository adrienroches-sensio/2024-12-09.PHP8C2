<?php

namespace App;

use Override;
use SensitiveParameter;

class Admin implements MemberInterface
{
    use MemberCountableTrait;

    public function __construct(
        private Member $member,
        private MemberLevel $level = MemberLevel::Admin,
    ) {
        MemberCount::add($this);
        MemberCount::remove($this->member);
    }

    public function __destruct()
    {
        MemberCount::remove($this);
    }

    #[Override]
    public function auth(
        string $login,

        #[SensitiveParameter]
        string $password,
    ): void {
        if ($this->level === MemberLevel::SuperAdmin) {
            return;
        }

        $this->member->auth($login, $password);
    }

    #[Override]
    public function __toString(): string
    {
        return $this->member . " as {$this->level->label()}";
    }
}
