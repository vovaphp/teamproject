<?php
include_once 'app/config.php';

spl_autoload_register(function ($className) {
    $classFile = 'app/' . str_replace('\\',DIRECTORY_SEPARATOR,$className) .'.php';
    if (file_exists($classFile)) {
        include_once $classFile;
        return true;
    }
    return false;
});

\core\Route::init();