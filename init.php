<?php

define('ROOTDIR', $_SERVER['DOCUMENT_ROOT']);
define('DEBUGMODE', true);

$configData = require ROOTDIR . '/config/index.php';
define('CONFIG', $configData);

if (DEBUGMODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

if (file_exists(ROOTDIR . '/src/helpers/functions.php')) {
    require_once ROOTDIR . '/src/helpers/functions.php';
}

// .env variables
loadEnv(ROOTDIR . '/.env');


// AUTOLOADER
spl_autoload_register(function ($className) {
    // Class Request -> Request.php
    $file = $className . '.php';

    $directories = [
        ROOTDIR . '/src/core/',
        ROOTDIR . '/src/helpers/',
        ROOTDIR . '/src/services/',
        ROOTDIR . '/src/utils/'
    ];

    foreach ($directories as $dir) {
        if (file_exists($dir . $file)) {
            require_once $dir . $file;
            return;
        }
    }
});
