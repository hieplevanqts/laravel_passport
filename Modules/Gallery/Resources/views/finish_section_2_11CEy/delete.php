<?php
session_start();
require_once 'connect.php';

$result = $obj->delete($_GET['id']);

unlink(PATH_UPLOAD . $result['image_main']['image']);  

foreach ($result['image_extra'] as $key => $value) {
    unlink(PATH_UPLOAD . $value['image']);  
}

$_SESSION['message'] = 'Xóa sản phẩm thành công!';

MyHelper::redirect('index.php');



