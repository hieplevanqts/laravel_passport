<?php
// echo dirname(__FILE__);
// die('This is a test');
define('DS', '/');
define('PATH_ROOT', dirname(__FILE__));
define('PATH_DATA', PATH_ROOT . DS . 'data' . DS);
define('PATH_HTML', PATH_ROOT . DS . 'html' . DS);
define('PATH_LIBS', PATH_ROOT . DS . 'libs' . DS);
define('PATH_UPLOAD', 'uploads' . DS);

define('DATA_PRODUCT', PATH_DATA . 'product.json');
define('COLUMNS_PRODUCT', ['id', 'name', 'price', 'description', 'images']);
define('EXTENTION_VALID', ['jpg', 'png']);
