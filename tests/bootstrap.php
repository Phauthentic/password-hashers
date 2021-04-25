<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

$wpHasherFile = 'tests' . DS . 'PasswordHash.php';
$wpHasherUrl = 'https://raw.githubusercontent.com/WordPress/WordPress/master/wp-includes/class-phpass.php';

if (!file_exists($wpHasherFile)) {
    file_put_contents($wpHasherFile, file_get_contents($wpHasherUrl));
}

include __DIR__ . DS . '..' . DS . 'vendor' . DS . 'autoload.php';
