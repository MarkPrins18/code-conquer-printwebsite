<?php

//make a hash of a password for testing.

$password = 'Test123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;