<?php
require 'vendor/autoload.php';
use MinishLink\WebPush\VAPID;

$keys = VAPID::createKeys();

echo "Public Key: " . $keys['publicKey'] . "\n<br>";
echo "Private Key: " . $keys['privateKey'] . "\n";