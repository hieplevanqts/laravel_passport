<?php
// echo $_SERVER['PHP_SELF'];
$currentFile = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
if($currentFile == 'index'){
    $title = 'Danh sách sản phẩm';
}elseif($currentFile == 'form' && isset($_GET['id'])){
    $title = 'Chỉnh sửa sản phẩm';
}elseif($currentFile == 'form'){
    $title = 'Thêm mới sản phẩm';
}elseif($currentFile == 'info'){
    $title = 'Chi tiết sản phẩm';
}

?>

<div class="x_title">
    <h2><?php echo $title ?></h2>
    <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
    </ul>
    <div class="clearfix"></div>
</div>