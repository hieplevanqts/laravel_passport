<?php
session_start();
require_once 'connect.php';
$objUpload = new Upload();

$id = null;
$product = null;

if(isset($_POST['type']) == 'edit'){
    $type = $_POST['type'];
    $id   = $_POST['id'];
    $product = $obj->get($id);
}
    $name        = $_POST['name'];
    $price       = $_POST['price'];
    $altMain     = $_POST['alt_main'];
    $altExtra    = $_POST['alt_extra'];
    $ordering    = $_POST['ordering'];
    $description = $_POST['description'];
    $description = $_POST['description'];
    $imageMain   = $_FILES['image_main'];
    $imageExtra  = $_FILES['image_extra'];

    $fileNameMain = $objUpload->uploadFile($imageMain, $altMain, @$product['image_main']);  // upload image main

    $arrExtra    = $objUpload->uploadFileMulty($imageExtra, $altExtra, $ordering, @$product['image_extra']);  // upload image extra

    $item = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'image_main' => $fileNameMain,
        'image_extra' => $arrExtra,
    ];

    if($type == 'edit'){
        $obj->update($item);
        $_SESSION['message'] = 'Cập nhật sản phẩm thành công!';
    }else{
        $obj->add($item);
        $_SESSION['message'] = 'Thêm mới sản phẩm thành công!';
    }


    MyHelper::redirect('index.php');



