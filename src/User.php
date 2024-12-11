<?php

namespace App;

use Override;
use Stringable;

class User implements Stringable
{
    public function __construct(
        private string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    #[Override]
    public function __toString(): string
    {
        return $this->getName();
    }
}
