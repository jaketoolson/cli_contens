<?php
$autoload = [
    'phar' => 'phar://app.phar/vendor/autoload.php',
    'vendor' => 'vendor/autoload.php'
];
if (file_exists($autoload['phar'])) {
    require_once $autoload['phar'];
} elseif (file_exists($autoload['vendor'])) {
    require_once $autoload['vendor'];
} else {
    throw new RuntimeException('Dependencies missing : [app.phar, or vendor]');
}

require_once 'helpers.php';