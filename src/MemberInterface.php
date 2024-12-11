<?php

namespace App;

use Stringable;

interface MemberInterface extends CanBeAuthenticatedInterface, Stringable
{
    public static function count(): int;
}
