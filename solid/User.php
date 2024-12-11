<?php

interface UserInterface
{
    public function setLanguage(string $language): void;

    public function getLanguage(): string;

    public function getName(): string;

    public function setName(string $name): void;
}

class User implements UserInterface
{
    private string $name;

    private string $language;

    public function setLanguage(string $language): void
    {
        if (!in_array(strtolower($language), ['fr', 'en'], true)) {
            throw new LogicException('Invalid language');
        }

        $this->language = strtoupper($language);
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

class StorageAwareUser implements UserInterface
{
    public function __construct(
        private UserInterface $user,
        private StorageInterface $storage,
    ) {
    }

    public function setLanguage(string $language): void
    {
        $this->user->setLanguage($language);
        $this->storage->set('language', $this->user->getLanguage());
    }

    public function getLanguage(): string
    {
        return $this->user->getLanguage();
    }

    public function getName(): string
    {
        return $this->user->getName();
    }

    public function setName(string $name): void
    {
        $this->user->setName($name);
    }
}

class AnonymiserUser implements UserInterface
{
    public function __construct(
        private UserInterface $user,
        private Closure $rule,
    ) {
    }

    public function setLanguage(string $language): void
    {
        $this->user->setLanguage($language);
    }

    public function getLanguage(): string
    {
        return $this->user->getLanguage();
    }

    public function getName(): string
    {
        if ( ($this->rule)() === false ) {
            return $this->user->getName();
        }

        return 'anonymous';
    }

    public function setName(string $name): void
    {
        if ( ($this->rule)() === false ) {
            $this->user->setName($name);

            return;
        }

        throw new LogicException('Not enough credentials');
    }
}

interface StorageInterface
{
    public function set(string $key, string $value): void;

    public function get(string $key): string;
}

class SessionStorage implements StorageInterface
{
    private SessionLifecycle $sessionLifecycle;

    public function __construct()
    {
        $this->sessionLifecycle = new SessionLifecycle();
    }

    public function set(string $key, string $value): void
    {
        $this->sessionLifecycle->start();
        $_SESSION[$key] = $value;
    }

    public function get(string $key): string
    {
        $this->sessionLifecycle->start();
        return $_SESSION[$key];
    }
}

class SessionLifecycle
{
    private bool $isStarted = false;

    public function start(): void
    {
        if ($this->isStarted === true) {
            return;
        }

        session_start();
        $this->isStarted = true;
    }
}

$session = new SessionStorage();

$user = new AnonymiserUser(
    new StorageAwareUser(
        new User(),
        $session,
    ),
    static function (): bool {
        return true;
    },
);

$user->setLanguage('fr');
$user->setLanguage('en');
$user->setName('Qezac');

echo $user->getLanguage() . PHP_EOL;
echo $user->getName() . PHP_EOL;
