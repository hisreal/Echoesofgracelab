<?php
$password = "12345"; // replace with the password you want to hash

$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;
