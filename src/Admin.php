<?php

namespace App;

use Override;
use SensitiveParameter;

class Admin implements MemberInterface
{
    /**
     * @var array<class-string<MemberInterface>, int>
     */
    private static array $count = [];

    public function __construct(
        private Member $member,
        private MemberLevel $level = MemberLevel::Admin,
    ) {
        self::add($this);
    }

    public function __destruct()
    {
        self::remove($this);
    }

    private static function add(MemberInterface $member): int
    {
        self::$count[$member::class] ??= 0;
        ++self::$count[$member::class];

        return self::$count[$member::class];
    }

    private static function remove(MemberInterface $member): int
    {
        self::$count[$member::class] ??= 0;
        --self::$count[$member::class];

        return self::$count[$member::class];
    }

    #[Override]
    public static function count(): int
    {
        return self::$count[static::class] ?? 0;
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
