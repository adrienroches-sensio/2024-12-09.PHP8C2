<?php

class Member extends User implements CanBeAuthenticatedInterface
{
    /**
     * @var array<class-string<Member>, int>
     */
    private static array $count = [];

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

    public function __destruct()
    {
        self::remove($this);
    }

    private static function add(Member $member): int
    {
        self::$count[$member::class] ??= 0;
        ++self::$count[$member::class];

        return self::$count[$member::class];
    }

    private static function remove(Member $member): int
    {
        self::$count[$member::class] ??= 0;
        --self::$count[$member::class];

        return self::$count[$member::class];
    }

    public static function count(): int
    {
        return self::$count[static::class] ?? 0;
    }

    #[Override]
    public function auth(
        string $login,

        #[SensitiveParameter]
        string $password
    ): bool {
        return $this->login === $login && $this->password === $password;
    }
}
