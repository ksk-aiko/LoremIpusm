<?php

// set the default file extension for autoloadinG
spl_autoload_extensions('.php');
// load classes without specifying the file extension
spl_autoload_register(function($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) include($file);
});

// use Composer's autoloader, so we can load third-party libraries
require_once 'vendor/autoload.php';