#!/usr/bin/env php
<?php

require_once __DIR__ . '/src/Member.php';
require_once __DIR__ . '/src/MemberLevel.php';
require_once __DIR__ . '/src/Admin.php';

$member1 = new Member('login1', 'password1', 1);
$member2 = new Member('login2', 'password2', 2);
$member3 = new Member('login3', 'password3', 3);
$member4 = new Member('login4', 'password4', 4);

$admin1 = new Admin('adminlogin1', 'adminpassword1', 1);
$admin2 = new Admin('adminlogin2', 'adminpassword2', 2, MemberLevel::SuperAdmin);
$admin3 = new Admin('adminlogin3', 'adminpassword3', 3);

echo 'Initial count :' . PHP_EOL;
echo '  |-> Member : ' . Member::count() . PHP_EOL;
echo '  |-> Admin : ' . Admin::count() . PHP_EOL;

unset($member3, $admin3);

echo 'After unset(member3, admin3) :' . PHP_EOL;
echo '  |-> Member : ' . Member::count() . PHP_EOL;
echo '  |-> Admin : ' . Admin::count() . PHP_EOL;
