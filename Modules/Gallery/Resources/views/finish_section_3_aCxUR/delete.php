<?php
session_start();
require_once 'connect.php';

$result = $obj->delete($_GET['id']);

foreach ($result['images'] as $key => $value) {
    unlink(PATH_UPLOAD . $value['image']);  
}

$_SESSION['message']['success'] = 'Xóa sản phẩm thành công!';

MyHelper::redirect('index.php');



