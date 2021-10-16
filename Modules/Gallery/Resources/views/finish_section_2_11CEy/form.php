<?php

require_once 'connect.php';

if(isset($_GET['id'])){
    $type = 'edit';
    $id = $_GET['id'];
    $product = $obj->get($id);
}

$elements = [
    [
        'label'   => Form::label('Name'),
        'element' => Form::input('text', 'name', @$product['name']),
    ],
    [
        'label'   => Form::label('Price'),
        'element' => Form::input('number', 'price', @$product['price']),
    ],
    [
        'label'   => Form::label('Description', false),
        'element' => Form::textArea('description', @$product['description']),
    ],
    [
        'label'   => Form::label('Hình ảnh chính', false),
        'element' => Form::inputImage('image_main') .
                     Form::input('text', 'alt_main', @$product['image_main']['alt'], 'col-md-5 ml-md-2', 'alt_main', false) .
                     Form::imageOld(@$product['image_main']['image'], @$id)
    ],
    [
        'label'   => Form::label('Hình ảnh phụ 1', false),
        'element' => Form::inputImage('image_extra[]') .
                     Form::input('text', 'alt_extra[]', @$product['image_extra'][0]['alt'], 'col-md-3 ml-md-1', 'alt_extra_1', false) .
                     Form::input('number', 'ordering[]', @$product['image_extra'][0]['ordering'], 'col-md-2 ml-md-1', 'ordering', false) .
                     Form::imageOld(@$product['image_extra'][0]['image'], @$id)
    ],
    [
        'label'   => Form::label('Hình ảnh phụ 2', false),
        'element' => Form::inputImage('image_extra[]') .
                     Form::input('text', 'alt_extra[]', @$product['image_extra'][1]['alt'], 'col-md-3 ml-md-1', 'alt_extra_2', false) .
                     Form::input('number', 'ordering[]', @$product['image_extra'][1]['ordering'], 'col-md-2 ml-md-1', 'ordering', false) .
                     Form::imageOld(@$product['image_extra'][1]['image'], @$id)
    ],
    [
        'label'   => Form::label('Hình ảnh phụ 3', false),
        'element' => Form::inputImage('image_extra[]') .
                     Form::input('text', 'alt_extra[]', @$product['image_extra'][2]['alt'], 'col-md-3 ml-md-1', 'alt_extra_3', false) .
                     Form::input('number', 'ordering[]', @$product['image_extra'][2]['ordering'], 'col-md-2 ml-md-1', 'ordering', false) .
                     Form::imageOld(@$product['image_extra'][2]['image'], @$id)
    ],
    [
        'element' => Form::button('Lưu') .
                    Form::input('hidden', 'type', @$type) .
                    Form::input('hidden', 'id', @$id),
        'type'    => 'btn-submit'
    ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once PATH_HTML . 'head.php' ?>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php require_once PATH_HTML . 'sidebar.php' ?>

            <?php require_once PATH_HTML . 'top-nav.php' ?>
            
            <!-- page content -->
            <div class="right_col" role="main" style="min-height: 2436px;">
                <?php require_once PATH_HTML . 'page-header.php' ?>
                
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <?php require_once PATH_HTML . 'x-title.php' ?>
                            
                            <div class="x_content">
                                <form action="handle.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left" autocomplete="off">
                                    <?= Form::show($elements) ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
            <?php require_once PATH_HTML . 'footer.php' ?>                                            
            
        </div>
        
        <?php require_once PATH_HTML . 'script.php' ?>                                            
    
</body>
</html>