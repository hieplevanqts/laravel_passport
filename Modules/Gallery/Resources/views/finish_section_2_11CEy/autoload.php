<?php

require_once 'define.php';
function __autoload($className) {
    $fileName = PATH_LIBS . $className . '.php';
    if (file_exists($fileName)) {
        require_once $fileName;
    }
}