<?php

//make a hash of a password for testing.

$password = 'Test1234!';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;