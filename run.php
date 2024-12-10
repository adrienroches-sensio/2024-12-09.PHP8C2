#!/usr/bin/env php
<?php

use App\Admin;
use App\BadCredentialsException;
use App\Member;
use App\MemberLevel;
use App\User;

require_once __DIR__ . '/vendor/autoload.php';

$member1 = new Member(new User('MemberName1'), 'login1', 'password1', 1);
$member2 = new Member(new User('MemberName2'), 'login2', 'password2', 2);
$member3 = new Member(new User('MemberName3'), 'login3', 'password3', 3);
$member4 = new Member(new User('MemberName4'), 'login4', 'password4', 4);

$admin1 = new Admin(
    new Member(new User('AdminName1'), 'adminlogin1', 'adminpassword1', 1)
);

$admin2 = new Admin(
    new Member(new User('AdminName2'), 'adminlogin2', 'adminpassword2', 2),
    MemberLevel::SuperAdmin,
);

$admin3 = new Admin(
    new Member(new User('AdminName3'), 'adminlogin3', 'adminpassword3', 3)
);

echo PHP_EOL . '----------------------------------------' . PHP_EOL;

echo ' >>> Static count' . PHP_EOL;

echo 'Initial count :' . PHP_EOL;
echo '  |-> Member : ' . Member::count() . PHP_EOL;
echo '  |-> Admin : ' . Admin::count() . PHP_EOL;

unset($member3, $admin3);

echo 'After unset(member3, admin3) :' . PHP_EOL;
echo '  |-> Member : ' . Member::count() . PHP_EOL;
echo '  |-> Admin : ' . Admin::count() . PHP_EOL;

echo PHP_EOL . '----------------------------------------' . PHP_EOL;

echo ' >>> __toString()' . PHP_EOL;

echo 'Member1 __toString : ' . $member1 . PHP_EOL;
echo 'Admin2 __toString : ' . $admin2 . PHP_EOL;

echo PHP_EOL . '----------------------------------------' . PHP_EOL;

echo ' >>> Bad credentials' . PHP_EOL;

try {
    $member2->auth('fake', 'fake');
} catch (BadCredentialsException $e) {
    echo $e->getMessage() . PHP_EOL;
}
