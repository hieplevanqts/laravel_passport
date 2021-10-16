<?php
session_start();
require_once 'connect.php';

$data = $obj->list();
$xhtml = '';
if(!empty($data)){
    foreach ($data as $key => $value) {
        $index = ++$key;
        $name = $value['name'];
        $price = number_format($value['price']);
        $imgMain = $value['image_main']['image'];
        $altMain = @$value['image_main']['alt'];
        $btnView = Form::showButtonAction('info.php?id='.$value['id'].'', 'primary', 'View', 'eye');
        $btnEdit = Form::showButtonAction('form.php?id='.$value['id'].'', 'success', 'Edit', 'pencil');
        $btnDelete = Form::showButtonAction('delete.php?id='.$value['id'].'', 'danger btn-delete', 'Delete', 'trash-o');
    
        $xhtml .= '
                <tr class="even pointer">
                    <td class="a-centre">'.$index.'</td>
                    <td>'.$name.'</td>
                    <td>
                        <img src="'.PATH_UPLOAD.$imgMain.'" width="100px" alt="'.$altMain.'">
                    </td>
                    <td>'.$price.'đ</td>
                    <td class="last">
                        '.$btnView.$btnEdit.$btnDelete.'
                    </td>
                </tr>
                ';
    }
}else{
    $xhtml .= '<tr><td colspan="5" class="text-center">Dữ liệu hiện rỗng</td></tr>';
}
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
                                <?= MyHelper::showNotify() ?>
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">STT</th>
                                                <th class="column-title">Tên sản phẩm</th>
                                                <th class="column-title">Hình ảnh</th>
                                                <th class="column-title">Giá sản phẩm</th>
                                                <th class="column-title no-link last"><span class="nobr">Hành động</span></th>
                                                <th class="bulk-actions" colspan="7">
                                                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions (
                                                        <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= $xhtml ?>
                                        </tbody>
                                    </table>
                                </div>
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